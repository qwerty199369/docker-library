<?php

$configs = [
    'mysqld'      => [
        'user'                            => 'mysql',
        'basedir'                         => "/usr/local/mysql/",
        'bind-address'                    => '127.0.0.1',
        'binlog-cache-size'               => '1M',// 默认为32k，如果事务多则可提升为2M
        'binlog-format'                   => 'MIXED',
        'character-set-server'            => 'utf8mb4',
        'character-sets-dir'              => "/usr/local/mysql/share/charsets/",
        'collation-server'                => 'utf8mb4_unicode_ci',
        'datadir'                         => '/usr/local/mysql/datadir/',
        # 'date-format'                     => '%Y-%m-%d',
        # 'datetime-format'                 => '%Y-%m-%d %H:%i:%s',
        'default-storage-engine'          => 'InnoDB',
        'default-time-zone'               => '+8:00',
        'default-tmp-storage-engine'      => 'InnoDB',
        'expire-logs-days'                => '14',
        'explicit-defaults-for-timestamp' => '1',
        # 'external-locking'                => '0',
        'general-log'                     => '0',
        'general-log-file'                => '/usr/local/mysql/general_log_file.log',
        'gtid-mode'                       => 'OFF', // 主从复制时建议设置为ON
        # 'initialize'                      => '0',
        # 'initialize-insecure'             => '0',
        # 'innodb-buffer-pool-chunk-size'   => '134217728',// 默认128M
        'innodb-buffer-pool-size'         => '768M',// 默认128M
        'innodb-data-file-path'           => 'ibdata1:16M:autoextend',
        # 'innodb-data-home-dir'                                     => '(No default value)',
        'innodb-disable-sort-file-cache'  => '1',
        # 'innodb-fast-shutdown'                                     => '1',
        'innodb-file-per-table'           => '1',
        'innodb-flush-log-at-trx-commit'  => '1',
        'innodb-flush-method'             => 'O_DIRECT',
        'innodb-flush-neighbors'          => '0',// 适用于SSD硬盘
        # 'innodb-force-recovery'                                    => '0',
        'innodb-io-capacity'              => '300', // 默认200
        # 'innodb-large-prefix'             => '1',
        'innodb-lock-wait-timeout'        => '90',
        'innodb-log-buffer-size'          => '16M',
        # 'innodb-log-checksums'            => '1',
        # 'innodb-log-compressed-pages'                              => '1',
        'innodb-log-file-size'            => '64M',
        'innodb-log-files-in-group'       => '3',
        # 'innodb-log-group-home-dir'                                => '(No default value)',
        # 'innodb-open-files'               => '128',
        # 'innodb-page-size'                                         => '16384',
        # 'innodb-read-ahead-threshold'                              => '56',
        'innodb-read-io-threads'          => '8',
        # 'innodb-strict-mode'              => '1',
        # 'innodb-support-xa'               => '1',
        # 'innodb-table-locks'              => '1',
        # 'innodb-thread-concurrency'       => '0',
        'innodb-write-io-threads'         => '4',
        'key-buffer-size'                 => '16M',
        'local-infile'                    => '1',
        'log-bin'                         => '/usr/local/mysql/log_bin_file',
        'log-error'                       => '/usr/local/mysql/log_error_file.log',
        'log-output'                      => 'FILE',
        'log-queries-not-using-indexes'   => '0',
        'log-timestamps'                  => 'SYSTEM',
        'log-error-verbosity'             => '1',
        # 'master-info-repository'                                   => 'FILE',
        'max-allowed-packet'              => '16M',
        # 'max-binlog-size'                                          => '1073741824',
        'max-connect-errors'              => '100000',// TODO 定期检查
        'max-connections'                 => '512',
        'max-heap-table-size'             => '64M',
        # 'max-slowlog-files'                                        => '0',
        # 'max-slowlog-size'                                         => '0',
        # 'max-user-connections'            => '0', // 0 = no limit
        'open-files-limit'                => '65535',
        # 'partition'                                                => 'ON',
        # 'performance-schema'                                       => '1',
        'pid-file'                        => '/usr/local/mysql/pid_file.pid',
        'plugin-dir'                      => "/usr/local/mysql/lib/mysql/plugin/",
        'port'                            => '3306',
        'query-cache-type'                => '0',
        # 'read-buffer-size'                                         => '131072',
        'read-rnd-buffer-size'            => '2M',
        'server-id'                       => '3306901',
        # 'skip-grant-tables'               => '0',
        'skip-name-resolve'               => '1',
        # 'skip-networking'                 => '0',
        # 'skip-show-database'              => '0',
        # 'skip-slave-start'                => '0',
        'slow-query-log'                  => '1',
        'slow-query-log-file'             => '/usr/local/mysql/slow_query_log_file.log',
        'socket'                          => '/tmp/mysql.sock',
        'sort-buffer-size'                => '1M',
        'sql-mode'                        => 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION,NO_AUTO_VALUE_ON_ZERO',
        'sync-binlog'                     => '1',
        # 'sysdate-is-now'                                           => '0',
        'table-open-cache'                => '4000',
        'table-open-cache-instances'      => '16',
        'thread-cache-size'               => '18',
        # 'time-format'                     => '%H:%i:%s',
        'tmp-table-size'                  => '64M',
        'tmpdir'                          => '/usr/local/mysql/tmpdir/',
        # 'transaction-isolation'           => 'REPEATABLE-READ',
        'wait-timeout'                    => '3600',
    ],
    'mysql'       => [
        'auto-rehash'           => '0',
        # 'auto-vertical-output'  => '0',
        'bind-address'          => '127.0.0.1',
        'default-character-set' => 'utf8mb4',
        # 'delimiter'             => ';',
        # 'vertical'              => '0',
        'local-infile'          => '1',
        'port'                  => '3306',
        'socket'                => '/tmp/mysql.sock',
        'safe-updates'          => '1',
        # 'connect-timeout'       => '0',
        'max-allowed-packet'    => '16M',
        # 'select-limit'          => '1000',
    ],
    'mysqld_safe' => [
        'open-files-limit' => '65535',
    ],
    'mysqldump'   => [
        'bind-address'          => '127.0.0.1',
        'comments'              => '1',
        'default-character-set' => 'utf8mb4',
        'max-allowed-packet'    => '64M',
        'port'                  => '3306',
        'quick'                 => '1',
        'socket'                => '/tmp/mysql.sock',
    ],
    'myisamchk'   => [

    ],
    'mysqlimport' => [
        'bind-address'          => '127.0.0.1',
        'default-character-set' => 'utf8mb4',
        'port'                  => '3306',
        'socket'                => '/tmp/mysql.sock',
    ],
];

$cnf = '# Created At ' . date('Y-m-d H:i:s') . "\n";

foreach ($configs as $block => $config) {
    if (count($config) === 0) {
        continue;
    }
    $cnf .= "\n[$block]\n";
    foreach ($config as $item => $value) {
        $cnf .= str_pad($item, 36, ' ', STR_PAD_RIGHT) . " = $value\n";
    }
}

echo file_put_contents('./generated.my.cnf', $cnf, LOCK_EX) !== false ? "success\n" : "fail\n";
