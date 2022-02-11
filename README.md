# collision
A simple PHP based collision detection implementation for 2D objects non-vector based
220210 - Man Kam - Collision Detection 

- objects are represented as 2D matrix instead of vector coordinates
- of course one can convert vector coordinates into matrix form
- complexity is O(n^^2)
- each object is represented by one NxN matrix with 1's being the shape (any shape)
- a collision matrix is calculated summing each respective pixel hence a 0 means the space is not occupied, 1 means one object occupies, and >1 means collisions
- it can also tell how many objects overlapped
- given nVidia GPU or some systolic array, this can be a O(n) algorithm if the matrix calculation can be parallel
- to convert it to 3D just just N*N*N matrix to represent an object as a point cloud; same idea calculating two collision matrixes and should be able to do 3D collision detection
- in the c2.php source, just change "N", "O", and $MaxSize will increase/decrease probability of collision to play around with
- tried different genObjs() algorithm; at first in c1.php I tried to do a random search type shape generation ending in deadend loop and as I don't want to do backtrack etc given this is not the main point of the assignment, I just opted to use a more deterministic method and the shape looks normalized (c2.php)
- again, the object point cloud can be generated from vector coordinates anyway 
- below is a test output of N = 10, O = 3, and MaxSize = N*N/8

fkam@fkam-ThinkPad-W540:~/projects/collision$ php --version
PHP 7.2.24-0ubuntu0.18.04.6 (cli) (built: May 26 2020 13:09:11) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.2.0, Copyright (c) 1998-2018 Zend Technologies
    with Zend OPcache v7.2.24-0ubuntu0.18.04.6, Copyright (c) 1999-2018, by Zend Technologies

fkam@fkam-ThinkPad-W540:~/projects/collision$ php c2.php

Object: 0
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
1111110000
1111111000

Object: 1
1110000000
1111111111
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000

Object: 2
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
0000111100

Collision Matrix:
1110000000
1111111111
0000000000
0000000000
0000000000
0000000000
0000000000
0000000000
1111110000
1111222100

Found collisions
fkam@fkam-ThinkPad-W540:~/projects/collision$ 

