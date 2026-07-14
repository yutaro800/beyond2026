<?php
/**
 * トップページ本文（index.html 相当）
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="hero">
  <div class="hero__visual hero__visual--photo">
    <?php for ( $i = 1; $i <= 7; $i++ ) : ?>
    <div class="hero__slide<?php echo 1 === $i ? ' is-active' : ''; ?>" style="<?php echo esc_attr( beyond_bg_style( sprintf( 'hero-visual-%02d.jpg', $i ) ) ); ?>"></div>
    <?php endfor; ?>
    <div class="hero__overlay">
      <h1 class="hero__logo">
        <img src="<?php echo esc_url( beyond_asset_url( 'beyond-logo.png' ) ); ?>" alt="BEYOND">
      </h1>
    </div>
  </div>
</section>

<section id="news" class="news section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">NEWS</span>
    <span class="section__title-ja">ニュース</span>
  </h2>
  <?php get_template_part( 'template-parts/news', 'latest' ); ?>
  </div>
</section>

<section id="concept" class="concept section section--black">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en section__title-en--compact" aria-hidden="true">CONCEPT</span>
  </h2>
  <div class="concept__logo"><img src="<?php echo esc_url( beyond_asset_url( 'beyond-logo-full.png' ) ); ?>" alt="BEYOND produced by RUNNING SCIENCE LAB"></div>
  <h2 class="concept__heading">#世界一自分を超えられるレース</h2>
  <div class="concept__repeat">
    <p class="concept__repeat-lead">Beyond2026は、「世界一自分を超えられるレース」をテーマに開催します。</p>

    <p>これまでBeyondを開催する中で、私たちは<br class="concept__br">自己ベスト更新だけではない、さまざまな目標を持つ<br class="concept__br">ランナーの皆さんと出会ってきました。</p>

    <div class="concept__repeat-types">
      <p>年齢とともに自己ベスト更新が難しくなり、年代別ベストを目指すランナー。</p>
      <p>目標とするレースに向けた実力を確かめる試金石として挑戦するランナー。</p>
      <p>そして、自身の限界を超え、PB更新を目指すランナー。</p>
    </div>

    <p>目標は一人ひとり異なります。<br class="concept__br">しかし、その一歩一歩には、それぞれの「自分を超える挑戦」があります。</p>

    <p>Beyond2026は、ランナー一人ひとりの多様な目標を肯定し、<br class="concept__br">その挑戦を全力で後押しします。</p>

    <p class="concept__repeat-close">あなたにとっての「Beyond」は何か。<br class="concept__br">その答えを見つけ、自分史上最高の挑戦ができる舞台を、<br class="concept__br">私たちは用意します。</p>
  </div>
  </div>
</section>

<section id="feature" class="feature section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">STRATEGY</span>
    <span class="section__title-ja">戦略</span>
  </h2>

  <div class="feature__split">
    <div class="feature__col">
      <div class="feature__col-head">
        <div class="feature__col-photo"><img src="<?php echo esc_url( beyond_asset_url( 'feature-pace.png' ) ); ?>" alt="BEYONDのペースメーカー"></div>
        <h3 class="feature__col-title">PACE</h3>
      </div>
      <div class="feature__col-body">
        <p>経験豊富なペーサー陣</p>
        <p>Beyond過去大会をはじめ、多くの大会で豊富なペースメーカー経験を持つランナーを、目標タイム2時間35分から4時間まで5分刻みで配置し、参加者の目標達成をサポートします。</p>
      </div>
    </div>
    <div class="feature__col">
      <div class="feature__col-head">
        <div class="feature__col-photo"><img src="<?php echo esc_url( beyond_asset_url( 'feature-course.png' ) ); ?>" alt="BEYONDのフラットコース"></div>
        <h3 class="feature__col-title">COURSE</h3>
      </div>
      <div class="feature__col-body">
        <p>傾斜0％のオールフラットコース</p>
        <p>Beyondの代名詞ともいえる、傾斜0%のオールフラットコース。コースレコードは2時間14分46秒を誇る、まさに高速コースです。目標達成を目指すランナーに最適なコースレイアウトとなっています。</p>
      </div>
    </div>
  </div>

  <div class="feature__split feature__split--support">
    <div class="feature__col feature__col--road">
      <div class="feature__col-head">
        <div class="feature__col-photo"><img src="<?php echo esc_url( beyond_asset_url( 'feature-road-to-beyond.jpg' ) ); ?>" alt="ROAD TO BEYOND 練習会"></div>
        <h3 class="feature__col-title">ROAD TO BEYOND</h3>
      </div>
      <div class="feature__col-body">
        <p>9月〜12月 Beyondまでのトレーニングをサポートする距離走練習会</p>
        <p class="feature__col-body-sub">対象：サブ2.75〜4</p>
        <p class="feature__schedule-more">詳細はこちら</p>
        <ul class="feature__schedule">
          <li><a href="https://moshicom.com/144049" target="_blank" rel="noopener">9/19(土) Eペース2時間走</a></li>
          <li><a href="https://moshicom.com/149837" target="_blank" rel="noopener">10/17(土) Eペース3時間走</a></li>
          <li><a href="https://moshicom.com/149838" target="_blank" rel="noopener">11/21(土) Mペース2時間走</a></li>
          <li>12月上旬 最終調整20km</li>
        </ul>
      </div>
    </div>
    <div class="feature__col feature__col--coach">
      <div class="feature__col-head">
        <div class="feature__col-photo feature__col-photo--logo">
          <img src="<?php echo esc_url( beyond_asset_url( 'ist-track-club-logo.png' ) ); ?>" alt="Ist陸上競技部">
        </div>
        <h3 class="feature__col-title">PERSONAL TRAINING</h3>
      </div>
      <div class="feature__col-body">
        <p>BEYONDだけに向けた完全個別指導。</p>
        <p>WORKOUTでも講師を務めるIst陸上競技部が徹底サポート。</p>
        <a href="#" class="feature__col-cta">お申し込みはこちら</a>
      </div>
    </div>
  </div>
  </div>
</section>

<section id="entry" class="entry section section--black">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">ENTRY</span>
    <span class="section__title-ja">エントリー</span>
  </h2>

  <div class="entry__top">
    <div class="entry__left entry__left--ticket">
      <a href="<?php echo esc_url( BEYOND_ENTRY_URL ); ?>" class="entry__cta" target="_blank" rel="noopener">エントリーはこちら</a>
      <p class="entry__period-label">エントリー期間</p>
      <p class="entry__period">８/７　１９：００<br>~１１/３０　２３：５９迄</p>
      <div class="entry__left-buttons">
        <a href="<?php echo esc_url( beyond_page_url( 'race-info' ) ); ?>" class="entry__btn">大会要項</a>
        <a href="<?php echo esc_url( beyond_page_url( 'guidelines' ) ); ?>" class="entry__btn">競技注意事項</a>
        <a href="https://moshicom.com/h/3tfqjftrzag4sgkc0g8" class="entry__btn" target="_blank" rel="noopener">駐車場・バスチケット</a>
      </div>
    </div>
    <div class="entry__right">
      <h3 class="entry__event-name">BEYOND 2026</h3>
      <p class="entry__event-date">2026.12.29 tue.<br>10:35start</p>

      <p class="entry__label">主催</p>
      <p class="entry__value">RUNNING SCIENCE LAB</p>

      <p class="entry__label">種目・定員</p>
      <p class="entry__value">フルマラソン　1000名</p>

      <p class="entry__label">会場</p>
      <p class="entry__value">一般財団法人日本自動車研究所<br>城里テストセンター高速周回路</p>
      <p class="entry__note">※開催場所についての問い合わせは必ずRUNNING SCIENCE LABまでお願いいたします。<br>日本自動車研究所では一切のお問い合わせ対応を行うことができません。</p>
    </div>
  </div>

  <hr class="entry__divider">

  <div class="entry__extras">
    <div class="entry__left entry__left--ticket entry__left--wide">
      <a href="https://forms.gle/dUVgaDC6cu7JUNYc6" class="entry__cta entry__cta--stacked" target="_blank" rel="noopener">
        <span class="entry__cta-title">ペーサー募集</span>
      </a>
      <p class="entry__period-label">募集内容</p>
      <p class="entry__period">レース当日、選手の目標タイムに合わせてペースをリードします。<br>サブ2:35〜4:00の各枠で募集しています。</p>
      <p class="entry__note">※エントリー開始時期は決定次第お知らせします</p>
    </div>
    <div class="entry__left entry__left--ticket entry__left--wide">
      <a href="https://forms.gle/y62hcPFHfuzGdXcu8" class="entry__cta" target="_blank" rel="noopener">ボランティア募集</a>
      <p class="entry__period-label">募集内容</p>
      <p class="entry__period">大会運営を支えるボランティアを募集しています。<br>受付・給水・フィニッシュエリアなど、各ポジションでご参加いただけます。</p>
      <p class="entry__note">今後のスケジュール<br>8月1日（土）〜10月31日（土）ボランティア募集期間<br>11月中旬　案内送付（マニュアル、事前説明会案内）<br>12月上旬　事前説明会実施　※自由参加</p>
    </div>
  </div>
  </div>
</section>

<section id="shop" class="shop section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">SHOP</span>
    <span class="section__title-ja">ショップ</span>
  </h2>
  <div class="shop__carousel">
    <button type="button" class="shop__arrow shop__arrow--prev" aria-label="前の商品">
      <span class="shop__arrow-icon" aria-hidden="true"></span>
    </button>
    <div class="shop__track">
      <div class="shop__viewport">
        <div class="shop__grid">
          <article class="shop__card">
            <div class="shop__card-photo"></div>
            <p class="shop__card-name">完走セット</p>
            <p class="shop__card-price">¥0</p>
          </article>
        </div>
      </div>
    </div>
    <button type="button" class="shop__arrow shop__arrow--next" aria-label="次の商品">
      <span class="shop__arrow-icon" aria-hidden="true"></span>
    </button>
  </div>
  </div>
</section>

<section id="a1beyond" class="a1beyond section section--black">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en section__title-en--compact">A1 BEYOND</span>
  </h2>
  <div class="a1beyond__logo"><img src="<?php echo esc_url( beyond_asset_url( 'a1beyond-logo.png' ) ); ?>" alt="A1 BEYOND feat.FH"></div>
  <p class="a1beyond__text">昨年ハイレベルな争いが繰り広げられたアマチュアランナーNo.1を決めるレースA1BEYONDを今年も開催。<br>皆様の挑戦をお待ちしております。</p>
  <div class="a1beyond__form">
    <a href="https://forms.gle/Mr9T9uRJqxZLyVYz7" class="entry__cta" target="_blank" rel="noopener">応募フォームはこちら</a>
    <a href="<?php echo esc_url( beyond_page_url( 'a1beyond-info' ) ); ?>" class="entry__btn">募集要項</a>
  </div>
  </div>
</section>

<section id="sponsor" class="sponsor section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">SPONSOR</span>
    <span class="section__title-ja">スポンサー</span>
  </h2>

  <div class="sponsor__tier">
    <div class="sponsor__logos sponsor__logos--gold">
      <a href="https://charbon-running.com/" class="sponsor__logo-frame sponsor__logo-frame--real" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( beyond_asset_url( 'sponsor-charbon.png' ) ); ?>" alt="charbon"></a>
      <a href="https://oresshu.com/" class="sponsor__logo-frame sponsor__logo-frame--real" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( beyond_asset_url( 'sponsor-orewa-sesshu.png' ) ); ?>" alt="オレは摂取す"></a>
    </div>
  </div>

  <div class="sponsor__tier">
    <div class="sponsor__logos sponsor__logos--silver">
      <a href="https://pfandh.jp/" class="sponsor__logo-frame sponsor__logo-frame--real" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( beyond_asset_url( 'sponsor-precision.png' ) ); ?>" alt="プレシジョン"></a>
      <div class="sponsor__logo-frame sponsor__logo-frame--real"><img src="<?php echo esc_url( beyond_asset_url( 'ist-track-club-logo.png' ) ); ?>" alt="Ist陸上競技部"></div>
    </div>
  </div>

  <div class="sponsor__tier">
    <div class="sponsor__logos sponsor__logos--bronze">
      <a href="https://retorunning.com/" class="sponsor__logo-frame sponsor__logo-frame--real" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( beyond_asset_url( 'sponsor-reto.png' ) ); ?>" alt="RETO"></a>
      <a href="https://www.instagram.com/chukasoba_natori/" class="sponsor__logo-frame sponsor__logo-frame--real" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( beyond_asset_url( 'sponsor-natori.png' ) ); ?>" alt="中華そばナトリ"></a>
    </div>
  </div>
  </div>
</section>

<section id="contact" class="contact section section--white">
  <div class="fade-in">
  <h2 class="section__title">
    <span class="section__title-en" aria-hidden="true">CONTACT</span>
    <span class="section__title-ja">お問い合わせ</span>
  </h2>
  <div class="contact__body">
  <p class="contact__text">大会に関するお問い合わせ・協賛についてはこちらのアドレスよりご連絡ください。</p>
  <p class="contact__email">beyond@rslab.tokyo</p>
  </div>
  </div>
</section>
