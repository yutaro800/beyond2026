<?php
/**
 * BEYOND 年度（大会エディション）の期間判定
 *
 * 例: 2026 年度 = 2026年4月1日 ～ 2027年3月31日
 */

defined( 'ABSPATH' ) || exit;

/**
 * 年度の開始月（4 = 4月1日開始、翌年3月31日まで）
 */
function beyond_news_edition_start_month(): int {
	$month = get_option( 'beyond_news_edition_start_month', 4 );
	return max( 1, min( 12, (int) $month ) );
}

/**
 * 表示対象の BEYOND 年度（0 = 全年）
 */
function beyond_news_edition_year(): int {
	if ( defined( 'BEYOND_NEWS_YEAR' ) ) {
		return max( 0, (int) BEYOND_NEWS_YEAR );
	}

	$year = get_option( 'beyond_news_year', 2026 );
	return max( 0, (int) $year );
}

/**
 * @deprecated beyond_news_edition_year() を使用
 */
function beyond_news_year(): int {
	return beyond_news_edition_year();
}

/**
 * 指定年度の期間（終了は翌年度開始日の直前＝非包含）
 *
 * @param int|null $edition_year 年度。null のとき表示対象年度。
 * @return array{start: string, end: string}|null end は exclusive（この日時以降は対象外）
 */
function beyond_news_edition_period( ?int $edition_year = null ): ?array {
	$edition_year = $edition_year ?? beyond_news_edition_year();
	if ( $edition_year <= 0 ) {
		return null;
	}

	$month = beyond_news_edition_start_month();
	$start = sprintf( '%04d-%02d-01 00:00:00', $edition_year, $month );
	$end   = sprintf( '%04d-%02d-01 00:00:00', $edition_year + 1, $month );

	return array(
		'start' => $start,
		'end'   => $end,
	);
}

/**
 * 投稿が指定 BEYOND 年度に属するか
 *
 * @param WP_Post  $post         投稿。
 * @param int|null $edition_year 年度。null のとき表示対象年度。
 */
function beyond_post_in_news_edition( WP_Post $post, ?int $edition_year = null ): bool {
	$period = beyond_news_edition_period( $edition_year );
	if ( ! $period ) {
		return true;
	}

	$tz = wp_timezone();
	try {
		$post_dt  = new DateTimeImmutable( $post->post_date, $tz );
		$start_dt = new DateTimeImmutable( $period['start'], $tz );
		$end_dt   = new DateTimeImmutable( $period['end'], $tz );
	} catch ( Exception $e ) {
		return false;
	}

	return $post_dt >= $start_dt && $post_dt < $end_dt;
}

/**
 * WP_Query 用 date_query（年度期間）
 *
 * @param int|null $edition_year 年度。null のとき表示対象年度。
 * @return array<int, array<string, mixed>>
 */
function beyond_news_edition_date_query( ?int $edition_year = null ): array {
	$period = beyond_news_edition_period( $edition_year );
	if ( ! $period ) {
		return array();
	}

	$tz     = wp_timezone();
	$end_dt = ( new DateTimeImmutable( $period['end'], $tz ) )->sub( new DateInterval( 'P1D' ) );

	return array(
		array(
			'after'     => substr( $period['start'], 0, 10 ),
			'before'    => $end_dt->format( 'Y-m-d' ),
			'inclusive' => true,
		),
	);
}
