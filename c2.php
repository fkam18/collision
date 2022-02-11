<?php
// 220210/Man Kam/
define("N", 10);  // dimension of 2d board (NxN)
define("O", 3);	  // number of objects
$Objects = array(); // global array of objects
$MaxSize = (int) (N*N)/8 ;  // max size of objects in pixels
$Collisions = array();

function genObjs() {
  global $Objects;
  global $MaxSize;
  for ($obj = 0; $obj < O; $obj++) {
    // init Obj
    for ($x = 0; $x < N; $x++) {
      for ($y = 0; $y < N; $y++) {
        $Objects[$obj][$x][$y]=0;
      }
    }
    // find a start row randomly
    $firstY = mt_rand(0,N-1);
    $firstX = mt_rand(0,N-1);
    $targetSize = mt_rand(4, $MaxSize);  // pixel count
    $targetSize = mt_rand(4, $MaxSize); // 4 being min
    $currentSize = 0;
    $avgRowSize = (int) sqrt($targetSize) + 10; // at least 
    if ($avgRowSize > N) $avgRowSize = N;
    for ($nY = $firstY; $nY < N; $nY++) {  // grow this obj downwards
      $rowSize = mt_rand(2, $avgRowSize);
      $startX = $firstX - (int) $rowSize/2;
      if ($startX < 0) { // shift to the right accordingly
        $endX = $firstX + (int)$rowSize/2  + abs($startX);
	$startX = 0;
      }
      $endX = $startX + $rowSize;
      for ($x = $startX; $x < $endX; $x++) {
        $Objects[$obj][$nY][$x] = 1;
      }
      $currentSize = $currentSize + $rowSize;
      if ($currentSize > $targetSize) break;
    }
  }
}

function printObjs() {
  global $Objects;
  for ($obj = 0; $obj < O; $obj++) {
    print("\nObject: $obj\n");
    for ($y=0; $y<N; $y++) {
      for ($x=0; $x<N; $x++) {
        print($Objects[$obj][$y][$x]);
      }
      print("\n");
    }
  }
}

function calcCollisions() {
  global $Collisions;
  global $Objects;

  for ($y=0; $y<N; $y++) {
    for ($x=0; $x<N; $x++) {
      $Collisions[$y][$x] = 0;
    }
  }
  for ($y = 0; $y < N; $y++) {
    for ($x = 0; $x < N; $x++) {
      for ($obj = 0; $obj < O; $obj++) {
        $Collisions[$y][$x] += $Objects[$obj][$y][$x];
      }
    }
  }
}

function printCollisions() {
  global $Collisions;
  print("\nCollision Matrix:\n");
  for ($y=0; $y<N; $y++) {
    for ($x=0; $x<N; $x++) {
      print($Collisions[$y][$x]);
    }
    print("\n");
  }
}

function foundCollisions() {
  global $Collisions;
  $found = False;
  for ($y=0;$y<N;$y++) {
    for ($x=0;$x<N;$x++) {
      if ($Collisions[$y][$x]>1) {
        $found = True;
        break;
      }
    }
  } 
  return $found;
}
genObjs();
printObjs();
calcCollisions();
printCollisions();

if (foundCollisions()) {
   print("\nFound collisions\n");
}
else {
   print("\nNo collisions\n");
}
?>
