<?php

declare(strict_types=1);

namespace Deployer;

set('default_stage', 'prod');

require 'recipe/symfony4.php';

set('ssh_multiplexing', false);

// Project name
set('application', 'Manen API');

// Project repository
set('repository', 'git@github.com:elythiel/manen-api.git');

// Set composer options
set('composer_options', '{{composer_action}} --no-dev --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader');

set('bin/yarn', function () {
    return locateBinaryPath('yarn');
});

// shared files & folders
add('shared_files', ['.env.local']);
add('shared_dirs', ['public/uploads']);
set('writable_dirs', [
    'var',
    'public/uploads',
]);

// Hosts
host('prod')
    ->hostname(getenv('DEPLOYER_HOST'))
    ->port((int) getenv('DEPLOYER_PORT'))
    ->user(getenv('DEPLOYER_USER'))
    ->stage('prod')
    ->set('deploy_path', getenv('DEPLOYER_DEPLOY_PATH'))
;

// [Optional]  Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');

// Build yarn locally
task('deploy:build:assets', function (): void {
    run('{{bin/yarn}} install');
    run('{{bin/yarn}} encore production');
})->local()->desc('Install front-end assets');

before('deploy:symlink', 'deploy:build:assets');

// Upload assets
task('upload:assets', function (): void {
    upload(__DIR__.'/public/build/', '{{release_path}}/public/build');
});

after('deploy:build:assets', 'upload:assets');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
