<?php
namespace BSFP\I;

use ArrayIterator;
use IteratorAggregate;

class Bag implements IteratorAggregate
{
  private $properties;

  public function __construct(array $properties)
  {
    $this->properties = $properties; 
  }

  /**
   * Get object parameter
   *
   * @param $key String
   * @param $default mixed
   * @return mixed
   */
  public function get(string $key, $default = null)
  {
    return $this->properties[$key] ?? $default;
  }

  /**
   * Get object parameter
   *
   * @param $key String
   * @param $default mixed
   * @return mixed
   */
  public function __get($key)
  {
    return $this->properties[$key] ?? null;
  }

  /**
   * Has object parameter
   *
   * @param $key String
   * @return bool
   */
  public function has(string $key): bool
  {
    return isset($this->properties[$key]);
  }

  /**
   * @return ArrayIterator
   */
  public function getIterator()
  {
    return new ArrayIterator($this->properties);
  }

  /**
   * 
   */
  public function map(callable $callback): Bag
  {
    $data = array_map($callback, $this->properties);

    return new Bag($data);
  }

  /**
   * 
   */
  public function filter(callable $callback): Bag
  {
    $data = array_filter($this->properties, $callback);

    return new Bag($data);
  }
}
