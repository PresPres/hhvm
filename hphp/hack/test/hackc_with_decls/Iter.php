<?hh
// RUN: %hackc -vHack.Lang.OptimizeLocalIterators=true --test-compile-with-decls %s | FileCheck %s
// RUN: %hackc -vHack.Lang.OptimizeLocalIterators=true --test-compile-with-decls --use-serialized-decls %s | FileCheck %s

function test() {
  foreach ($x as $k => $v) {
    // CHECK: IterInit <WithKeys> 0 $x {{L[0-9]+}}
    $x[$k] += 12;
    // CHECK: IterNext <WithKeys> 0 $x {{L[0-9]+}}
  }

  foreach ($y as $k => $v) {
    // CHECK: IterInit <WithKeys> 0 $y {{L[0-9]+}}
    $y[$k] = 12;
    // CHECK: IterNext <WithKeys> 0 $y {{L[0-9]+}}
  }

  foreach ($z as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    $z[] = 12;
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($q as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    $q[$k + 1] = 12;
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($r as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    $r[5] = 12;
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($s as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    unset($s);
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($t as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    unset($t[$k]);
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($u as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    unset($u[$k]);
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($a as $k => $v) {
    // CHECK: IterInit <WithKeys> 0 $a {{L[0-9]+}}
    $a[$k] = $a[5] + 1;
    // CHECK: IterNext <WithKeys> 0 $a {{L[0-9]+}}
  }

  foreach ($b as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    bar(inout $b);
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($c as $k => $v) {
    // CHECK: IterInit <WithKeys> 0 $c {{L[0-9]+}}
    bar(inout $c[$k]);
    // CHECK: IterNext <WithKeys> 0 $c {{L[0-9]+}}
  }

  foreach ($d as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    bar(inout $d[5]);
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($f as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    foreach ($v as $k => $m) {
    }
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($g as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    foreach ($v as $kk => $g) {
    }
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($h as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    $h->one();
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }

  foreach ($i as $k => $v) {
    // CHECK: IterInit <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
    $i = 5;
    // CHECK: IterNext <BaseConst WithKeys> 0 {{_[0-9]+}} {{L[0-9]+}}
  }
}

