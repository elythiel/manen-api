<?php
declare(strict_types=1);

namespace Deployer;

set('default_stage', 'prod');

require 'recipe/symfony.php';

// Project name
set('application', 'Manen API');

// Project repository
set('repository', 'git@github.com:elythiel/manen-api.git');

// Set composer options
set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-scripts');

// shared files & folders
add('shared_files', ['.env.local']);
add('shared_dirs', ['public/upload']);

// Hosts
host('prod')
    ->hostname(getenv('DEPLOYER_HOST'))
    ->port((int) getenv('DEPLOYER_PORT'))
    ->user(getenv('DEPLOYER_USER'))
    ->stage('prod')
    ->set('deploy_path', '/var/www/html')
;

// [Optional]  Migrate database before symlink new release.
// before('deploy:symlink', 'database:migrate');

// Build yarn locally
task('deploy:build:assets', function (): void {
    run('yarn install');
    run('yarn encore production');
})->local()->desc('Install front-end assets');

before('deploy:symlink', 'deploy:build:assets');

// Upload assets
task('upload:assets', function (): void {
    upload(__DIR__.'/public/build/', '{{release_path}}/public/build');
});

after('deploy:build:assets', 'upload:assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
