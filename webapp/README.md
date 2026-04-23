# ビジネスマッチングシステム

Laravel 11 + MySQL によるイベント向けビジネスマッチングWebアプリです。

## 必要環境

- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js（任意、CDN利用のため不要）

## セットアップ

```bash
# 1. 依存パッケージインストール
composer install

# 2. 環境設定ファイルを作成
cp .env.example .env
php artisan key:generate

# 3. .env を編集してDB接続情報・メール設定を入力
#    DB_DATABASE, DB_USERNAME, DB_PASSWORD
#    MAIL_MAILER=smtp, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS

# 4. マイグレーション＋シーダー実行
php artisan migrate --seed

# 5. 開発サーバー起動
php artisan serve

# 6. キューワーカー起動（メール送信に必要）
php artisan queue:work
```

## 管理者アカウント

シーダー実行後に作成されます。`AdminUserSeeder` を確認してください。

## 画面一覧

### 参加者

| URL | 画面 |
|-----|------|
| `/register` | 新規登録 |
| `/login` | ログイン |
| `/profile/edit` | プロフィール登録・編集 |
| `/matching` | おすすめ一覧 |
| `/contact/sent` | 送信完了 |

### 管理者

| URL | 画面 |
|-----|------|
| `/admin/login` | 管理者ログイン |
| `/admin/dashboard` | ダッシュボード |
| `/admin/participants` | 参加者一覧 |
| `/admin/participants/{id}` | 参加者詳細 |
| `/admin/notifications` | 通知履歴 |

## キュー設定

本番環境では `QUEUE_CONNECTION=database`（デフォルト）を使用します。  
Supervisord 等でキューワーカーを常駐させてください。

```bash
php artisan queue:work --tries=3 --backoff=60
```
