import json

with open('cpus.json') as f:
  cpus = json.load(f)

print ('INSERT INTO CPUs (Name, Cores, Threads, Type, CpuMark, SingleThreadMark, TDP, PowerPerf, Socket, ReleaseDate) VALUES')

for cpu in cpus['data']:
    cpumark = int(cpu['cpumark'].replace(',',''))
    singlethreadmark = 0 
    if 'NA' not in cpu['thread']:
        singlethreadmark = int(cpu['thread'].replace(',',''))
    tdp = 0
    if 'NA' not in cpu['tdp']:
        tdp = float(cpu['tdp'].replace(',',''))
    powerperf = 0
    if 'NA' not in cpu['powerPerf']:
        powerperf = float(cpu['powerPerf'].replace(',',''))

    cores = int(cpu['cores'])
    threads = int(cpu['logicals']) * cores
    print (f"('{cpu['name']}', {cores}, {threads},'{cpu['cat']}', {cpumark}, {singlethreadmark}, {tdp}, {powerperf},'{cpu['socket']}', '{cpu['date']}'),")

