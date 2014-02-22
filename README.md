# Bench

Basic benchmarking

## Usage

### Using `bench\mark`

```php
bench\mark('somekey');
$result = calculateSomething();
echo bench\format(bench\collector()), PHP_EOL;
```

### Using `bench\invoke`

```php
$result = bench\invoke('calculateSomething');
echo bench\format(bench\collector()), PHP_EOL;
```

### Using `bench\wrap`

```php
$fn = bench\wrap('calculateSomething');
$result = $fn();
echo bench\format(bench\collector()), PHP_EOL;
```

### Using `bench\collector`

`bench\collector` will collect up results of `bench\invoke` and `bench\wrap`.

When `bench\collector` is invoked without arguments it will return all results collected.

When there is only one result it will return that else it will return an array.

```php
bench\invoke('calculateSomething');
bench\invoke('calculateSomething');
foreach (bench\formatTimes(bench\collector()) as $time) {
	echo $time, PHP_EOL;
}
```