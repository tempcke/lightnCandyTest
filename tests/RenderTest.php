<?php

namespace LogikosTest;

use LightnCandy\LightnCandy;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class RenderTest extends TestCase {

  private $jsonData = '{
    "title": "Some People",
    "people": [
      { "name": "Fred", "age": 30 },
      { "name": "Bill", "age": 35 }
    ]
  }';

  private $data = [
    "title" => "Some People",
    "people" => [
      [ "name" => "Fred", "age"=> 30 ],
      [ "name"=> "Bill", "age"=> 35 ]
    ]
  ];

  public function testFoo() {
    Assert::assertTrue(true);
  }

  public function testParse() {
    $data = json_decode($this->jsonData, true);
    $template = $this->template();
    $output = $this->render($template, $data);
    Assert::assertTrue(true);
  }

  protected function render($template, array $data) {
    $function = eval(LightnCandy::compile($template));
    return $function($data);
  }

  protected function template() {
    return <<<template
<h2>{{title}}</h2>
<ol>
{{#each people}}
  <li>Hi, my name is {{name}} and I am {{age}}. {{foo}}
{{/each}}
</ol>
template;

  }

}