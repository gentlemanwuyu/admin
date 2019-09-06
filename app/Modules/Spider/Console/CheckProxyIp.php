<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/9/6
 * Time: 19:35
 */

namespace App\Modules\Spider\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class CheckProxyIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:check_proxy_ip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '检测代理IP是否有效';

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
        $ips = [
            ['ip' => '123.207.57.145', 'port' => '1080', 'scheme' => 'http'],
            ['ip' => '118.180.166.195', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '59.45.13.220', 'port' => '57868', 'scheme' => 'http'],
            ['ip' => '182.35.87.76', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '222.223.182.66', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '115.233.210.218', 'port' => '808', 'scheme' => 'http'],
            ['ip' => '61.135.155.82', 'port' => '443', 'scheme' => 'http'],
            ['ip' => '183.23.72.50', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '112.87.69.127', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '27.208.189.162', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '118.31.60.96', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '117.127.16.208', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '1.198.72.32', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '111.231.94.44', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '163.204.245.171', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '119.254.94.114', 'port' => '34422', 'scheme' => 'http'],
            ['ip' => '221.224.136.211', 'port' => '35101', 'scheme' => 'http'],
            ['ip' => '120.132.53.20', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '218.27.84.219', 'port' => '8118', 'scheme' => 'http'],
            ['ip' => '121.15.254.156', 'port' => '888', 'scheme' => 'http'],
            ['ip' => '218.65.219.119', 'port' => '47732', 'scheme' => 'http'],
            ['ip' => '112.84.178.21', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '47.106.197.184', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '119.23.110.100', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '193.112.41.54', 'port' => '808', 'scheme' => 'http'],
            ['ip' => '124.156.108.71', 'port' => '82', 'scheme' => 'http'],
            ['ip' => '120.132.52.6', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '116.62.234.0', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '111.231.92.21', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '47.107.38.138', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '47.106.192.167', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '58.247.127.145', 'port' => '53281', 'scheme' => 'http'],
            ['ip' => '27.208.71.228', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '218.27.154.144', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '49.83.59.101', 'port' => '8118', 'scheme' => 'http'],
            ['ip' => '49.70.32.69', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '171.13.4.54', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '113.121.21.134', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '210.22.5.117', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '47.110.130.152', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '1.197.204.138', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '101.132.168.235', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '140.250.176.196', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '1.197.178.220', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '118.122.124.5', 'port' => '1080', 'scheme' => 'http'],
            ['ip' => '112.126.102.192', 'port' => '1080', 'scheme' => 'http'],
            ['ip' => '118.144.149.200', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '119.41.236.180', 'port' => '8010', 'scheme' => 'http'],
            ['ip' => '47.98.246.203', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '111.231.93.66', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '60.205.202.3', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '106.75.140.205', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '27.46.21.111', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '61.186.172.12', 'port' => '10809', 'scheme' => 'http'],
            ['ip' => '116.62.184.163', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '120.236.219.11', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '112.85.171.109', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '39.108.170.173', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '120.194.61.62', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '36.66.199.110', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '175.43.35.14', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '45.221.73.46', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '124.193.37.5', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '60.208.147.163', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '222.189.245.33', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '119.179.138.16', 'port' => '8060', 'scheme' => 'http'],
            ['ip' => '120.132.52.137', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '182.92.169.109', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '203.130.46.108', 'port' => '9090', 'scheme' => 'http'],
            ['ip' => '117.191.11.109', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '112.126.65.236', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '122.4.41.53', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '117.191.11.72', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '140.143.153.114', 'port' => '8888', 'scheme' => 'http'],
            ['ip' => '117.191.11.75', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '193.112.6.56', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '123.52.97.183', 'port' => '9999', 'scheme' => 'http'],
            ['ip' => '117.191.11.111', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '120.194.109.179', 'port' => '47812', 'scheme' => 'http'],
            ['ip' => '39.108.2.79', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '121.16.132.125', 'port' => '808', 'scheme' => 'http'],
            ['ip' => '221.6.138.154', 'port' => '41880', 'scheme' => 'http'],
            ['ip' => '47.89.37.177', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '171.80.96.22', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '111.29.3.223', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '121.41.30.32', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '175.153.20.12', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '139.196.22.147', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '111.29.3.191', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '118.24.38.27', 'port' => '808', 'scheme' => 'http'],
            ['ip' => '111.29.3.192', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '111.29.3.184', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '113.65.5.65', 'port' => '8118', 'scheme' => 'http'],
            ['ip' => '111.29.3.220', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '111.29.3.225', 'port' => '8080', 'scheme' => 'http'],
            ['ip' => '122.190.230.205', 'port' => '61234', 'scheme' => 'http'],
            ['ip' => '119.23.238.202', 'port' => '3128', 'scheme' => 'http'],
            ['ip' => '111.29.3.188', 'port' => '80', 'scheme' => 'http'],
            ['ip' => '101.231.50.154', 'port' => '8000', 'scheme' => 'http'],
            ['ip' => '221.226.94.218', 'port' => '110', 'scheme' => 'http'],
        ];

        foreach ($ips as $ip) {
            try {
                $client = new Client;
                $response = $client->get('http://icanhazip.com/', [
                    'proxy' => [$ip['scheme'] => $ip['scheme'] . '://' . $ip['ip'] . ':' . $ip['port']],
                    'timeout' => 8,
                ]);
                if (200 == $response->getStatusCode() && $ip['ip'] == trim($response->getBody()->getContents())) {
                    $this->info($ip['scheme'] . '://' . $ip['ip'] . ':' . $ip['port']);
                }
            }catch (\Exception $e) {
                Log::info('[' . get_class($e) . ']' . $e->getMessage() . ', ' . $ip['scheme'] . '://' . $ip['ip'] . ':' . $ip['port']);
            }
        }
    }

    protected function message($msg)
    {
        Log::info('[Spider:CheckProxyIp]'.$msg);
        $this->info($msg);
    }
}