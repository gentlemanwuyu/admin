<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdminInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install {--seed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->execShellWithPrettyPrint("php artisan module:migrate");
        $this->createAdminAccount();
        // 是否填充数据
        if ($this->option('seed')) {
            $this->execShellWithPrettyPrint("php artisan module:seed");
        }
    }

    /**
     * 执行脚本
     *
     * @param  string $command
     * @return mixed
     */
    public function execShellWithPrettyPrint($command)
    {
        $this->info('---');
        $this->info($command);
        $output = shell_exec($command);
        $this->info($output);
        $this->info('---');
    }

    /**
     * 创建管理员账号
     *
     * @return mixed
     */
    public function createAdminAccount()
    {
        return DB::table('users')->insert([
            'name' => 'admin',
            'email' => '492444775@qq.com',
            'password' => bcrypt('gentleman'),
            'is_admin' => 1,
        ]);
    }
}
