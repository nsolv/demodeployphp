<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'demodeployphp');

// Project repository
set('repository', 'git@github.com:nsolv/demodeployphp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);


// Hosts
host('demodeployphp.nsolv.ru')
    ->user('ubuntu')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    // 'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
