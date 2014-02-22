# Bench

Basic benchmarking

## Usage

### Using `bench\mark`

```php
bench\mark('somekey');
$result = calculateSomething();
echo sprintf('%01.2f secs', bench\mark('somekey')), PHP_EOL;
```

### Using `bench\invoke`

```php
$result = bench\invoke('calculateSomething');
echo sprintf('%01.2f secs', bench\collector()), PHP_EOL;
```

### Using `bench\wrap`

```php
$fn = bench\wrap('calculateSomething');
$fn();
echo sprintf('%01.2f secs', bench\collector()), PHP_EOL;
```

### Using `bench\collector`

`bench\collector` will collect up results of `bench\invoke` and `bench\wrap`.

When `bench\collector` is invoked without arguments it will return all results collected.

When there is only one result it will return that else it will return an array.

```php
bench\invoke('calculateSomething');
bench\invoke('calculateSomething');
var_dump(bench\collector());
// array(2) {
//   '5307fd2fc1e01' => double(1.0011260509491)
//   '5307fd30c22b1' => double(1.0007309913635)
// }
```