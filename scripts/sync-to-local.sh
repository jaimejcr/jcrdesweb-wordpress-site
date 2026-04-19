#!/usr/bin/env bash
set -euo pipefail

LOCAL_WP_CONTENT="/Users/macjaime/portfolio-mini-proyectos/wordpress-local-sites/jcr-lab/app/public/wp-content"
REPO_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

mkdir -p "$LOCAL_WP_CONTENT/themes/jcrdesweb-child"
mkdir -p "$LOCAL_WP_CONTENT/plugins/jcr-site-core"
mkdir -p "$LOCAL_WP_CONTENT/mu-plugins"

rsync -av --delete "$REPO_ROOT/site/wp-content/themes/jcrdesweb-child/" "$LOCAL_WP_CONTENT/themes/jcrdesweb-child/"
rsync -av --delete "$REPO_ROOT/site/wp-content/plugins/jcr-site-core/" "$LOCAL_WP_CONTENT/plugins/jcr-site-core/"
rsync -av --delete "$REPO_ROOT/site/wp-content/mu-plugins/" "$LOCAL_WP_CONTENT/mu-plugins/"

echo "Sync completado hacia: $LOCAL_WP_CONTENT"
