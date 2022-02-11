<?php
define("N", 10);  // dimension of 2d board (NxN)
define("O", 5);	  // number of objects
$Objects = array(); // global array of objects
$MaxSize = 15;  // max size of objects in pixels

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
    // pick one point to gen shape given size
    $nX = mt_rand(0,N-1);
    $nY = mt_rand(0,N-1);
    $targetSize = mt_rand(4, $MaxSize); // 4 being min
    $currentSize = 0;
    while ($currentSize <= $targetSize) {
      $Objects[$obj][$nX][$nY] = 1;
      $currentSize++;
      $dirOK = False;
      do {
        $nextDir = mt_rand(1,8); // LoL find next dot, NW,N,NE,E,SE,S,SW,W
        switch ($nextDir) {
          case 1: // NW
            $nX1 = $nX - 1; $nY1 = $nY - 1; break;
          case 2: // N
            $nX1 = $nX; $nY1 = $nY - 1; break;
          case 3: // NE
            $nX1 = $nX + 1; $nY1 = $nY - 1; break;
          case 4:  // E
            $nX1 = $nX + 1; $nY1 = $nY; break;
          case 5:  // SE
            $nX1 = $nX + 1; $nY1 = $nY + 1; break;
          case 6:  // S
            $nX1 = $nX ; $nY1 = $nY + 1; break;
          case 7:  // SW
            $nX1 = $nX - 1 ; $nY1 = $nY + 1; break;
          case 8:  // W
            $nX1 = $nX - 1 ; $nY1 = $nY; break;
        }
        if ($nX1 >= 0 && $nX1 < N) {
          if ($nY1 >= 0 && $nY1 < N) {
            if ($Objects[$obj][$nX1][$nY1] != 1) {
		$nX = $nX1;
		$nY = $nY1;	
		$dirOK = True;
            }
          }
        }
      } while (! $dirOK);
    }
  }
}

function printObjs() {
  global $Objects;
  for ($obj = 0; $obj < O; $obj++) {
    print("Object: $obj\n");
    for ($y=0; $y<N; $y++) {
      for ($x=0; $x<N; $x++) {
        print($Objects[$obj][$x][$y]);
      }
      print("\n");
    }
  }
}

genObjs();
printObjs();
?>
