# 本番未反映リスト（BEYOND 2026）

**Git push 済み ≠ 本番（rslab.tokyo）反映済み**

ローカル／GitHub にだけある変更は、普段の Wi‑Fi からデプロイが必要です。

## 手順

1. SSH 確認: `ssh -i ~/Downloads/sslab.pem -o ConnectTimeout=8 -o BatchMode=yes ec2-user@54.178.41.148 echo ok`
2. デプロイ: `bash scripts/deploy-production.sh`
3. 確認: https://rslab.tokyo/beyond-2026/
4. 下記を `[x]` にし、`deploy-manifest.txt` を空にする

## 未反映

- [ ] **2026-07-25** — ブロンズ: THE EKIDEN PODCAST 追加（https://theekiden.com）
  - `deploy-manifest.txt` にファイル一覧あり

## 反映済み（ログ）

<!-- 例: - [x] 2026-07-17 — 初回本番デプロイ -->
