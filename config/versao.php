<?php
// config/versao.php
// Arquivo de configuração de versão do sistema

// Versão atual do sistema
define('VERSAO_ATUAL', '1.0.1');

// Configurações do GitHub para auto-atualização
define('GITHUB_REPO', 'kidon/zelador-digital'); // ALTERE PARA SEU REPOSITÓRIO
define('GITHUB_BRANCH', 'main');

// Token do GitHub (opcional, apenas para repositórios privados)
define('GITHUB_TOKEN', '');

// URLs do GitHub
define('GITHUB_API_URL', 'https://api.github.com/repos/' . GITHUB_REPO . '/commits?sha=' . GITHUB_BRANCH . '&per_page=1');
define('GITHUB_ZIP_URL', 'https://github.com/' . GITHUB_REPO . '/archive/' . GITHUB_BRANCH . '.zip');
define('GITHUB_TAGS_URL', 'https://api.github.com/repos/' . GITHUB_REPO . '/tags');

// Pastas do sistema
define('PASTA_SISTEMA', __DIR__ . '/../');
define('PASTA_TEMP', __DIR__ . '/../temp/');
define('PASTA_BACKUP', __DIR__ . '/../backups/');

// Configurações de atualização
define('INTERVALO_VERIFICACAO', 86400);
define('MAX_BACKUPS', 5);
?>
