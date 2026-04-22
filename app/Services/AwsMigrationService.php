<?php

namespace App\Services;

use Aws\MigrationHub\MigrationHubClient;
use Aws\CloudWatch\CloudWatchClient;
use Exception;

class AwsMigrationService
{
    protected MigrationHubClient $migrationClient;
    protected CloudWatchClient $cloudWatchClient;

    public function __construct()
    {
        $config = [
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'version' => 'latest',
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ];

        $this->migrationClient = new MigrationHubClient($config);
        $this->cloudWatchClient = new CloudWatchClient($config);
    }

    /**
     * Fetch all migration tasks status.
     */
    public function getMigrationStatuses(): array
    {
        try {
            $result = $this->migrationClient->listMigrationTasks();
            return $result->get('MigrationTaskSummaryList') ?? [];
        } catch (Exception $e) {
            return [['MigrationTaskName' => 'Error', 'Status' => 'Failed', 'ProgressPercent' => 0]];
        }
    }

    /**
     * Fetch health metrics for a specific VM.
     */
    public function getVmHealthMetrics(string $instanceId): array
    {
        try {
            $result = $this->cloudWatchClient->getMetricStatistics([
                'Namespace'  => 'AWS/EC2',
                'MetricName' => 'CPUUtilization',
                'Dimensions' => [['Name' => 'InstanceId', 'Value' => $instanceId]],
                'StartTime'  => strtotime('-1 hour'),
                'EndTime'    => time(),
                'Period'     => 300,
                'Statistics' => ['Average'],
            ]);
            return $result->get('Datapoints') ?? [];
        } catch (Exception $e) {
            return [];
        }
    }
}
