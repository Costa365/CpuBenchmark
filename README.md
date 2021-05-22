# CpuBenchmark
CPU Benchmark PHP application. Hosted on [costa365.rf.gd/cpubenchmark/](http://costa365.rf.gd/cpubenchmark/).

## Database
The data is stored in the following table in a MySQL database:
```sql
CREATE TABLE `CPUs` (
  `Name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Cores` int(11) DEFAULT NULL,
  `Treads` int(11) DEFAULT NULL,
  `Type` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `CpuMark` int(11) DEFAULT NULL,
  `SingleThreadMark` int(11) DEFAULT NULL,
  `TDP` float DEFAULT NULL,
  `PowerPerf` float DEFAULT NULL,
  `Socket` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `ReleaseDate` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

The data is populated as shown below:
```sql
INSERT INTO CPUs (Name, Cores, Treads, Type, CpuMark, SingleThreadMark, TDP, PowerPerf, Socket, ReleaseDate) VALUES
('Intel i7-1234', 2, 4, 'Desktop', 9876, 1004, 35, 88.3, 'rPGA988B', 'Apr 2010'),
...
```
Use db/createdb.py to convert the json file, that you can obtain from [CPU Mega Page](https://www.cpubenchmark.net/CPU_mega_page.html), to the sql query that inserts all the CPU info.

The database config file, should be created in cpubenchmark/config/database.ini, with the following contents:
```
servername = xxx
username = xxx
password = xxx
dbname = xx
```