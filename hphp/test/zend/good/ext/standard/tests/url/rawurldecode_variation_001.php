<?hh
/* Prototype  : proto string rawurldecode(string str)
 * Description: Decodes URL-encodes string
 * Source code: ext/standard/url.c
 * Alias to functions:
 */

// NB: basic functionality tested in tests/strings/001.phpt

function test_error_handler($err_no, $err_msg, $filename, $linenum, $vars) :mixed{
    echo "Error: $err_no - $err_msg, $filename($linenum)\n";
}
<<__EntryPoint>> function main(): void {
set_error_handler(test_error_handler<>);
echo "*** Testing rawurldecode() : usage variations ***\n";

// Initialise function arguments not being substituted (if any)


//array of values to iterate over
$values = vec[
      // empty data
      "",
      '',
];

// loop through each element of the array for str

foreach($values as $value) {
      echo "\nArg value ".(string)$value."\n";
      try { var_dump( rawurldecode($value) ); } catch (Exception $e) { echo "\n".'Warning: '.$e->getMessage().' in '.__FILE__.' on line '.__LINE__."\n"; }
};

echo "Done";
}
