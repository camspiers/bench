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
echo sprintf('%01.2f secs', bench\collector()[0]), PHP_EOL;
```

### Using `bench\wrap`

```php
$fn = bench\wrap('calculateSomething');
$fn();
echo sprintf('%01.2f secs', bench\collector()[0]), PHP_EOL;
```