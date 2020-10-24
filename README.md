# CpuBenchmark
CPU Benchmark PHP application. Hosted on [costa365.rf.gd/cpubenchmark/](http://costa365.rf.gd/cpubenchmark/).

## Database
The data is stored in the following table:
```sql
CREATE TABLE `CPUs` (
  `Name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Cores` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Type` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `CpuMark` int(11) DEFAULT NULL,
  `SingleThreadMark` int(11) DEFAULT NULL,
  `TDP` int(11) DEFAULT NULL,
  `PowerPerf` int(11) DEFAULT NULL,
  `ReleaseDate` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

The data is populated as shown below:
```sql
INSERT INTO CPUs (Name, Cores, Type, CpuMark, SingleThreadMark, TDP, PowerPerf, ReleaseDate) VALUES
('Intel i7-1234', '2 (2 logical cores per physical)', 'Desktop', 9876, 1004, 35, 88, 'Apr 2010'),
...
```

The database config file, should be created in cpubenchmark/config/database.ini, with the following contents:
```
servername = xxx
username = xxx
password = xxx
dbname = xx
```
