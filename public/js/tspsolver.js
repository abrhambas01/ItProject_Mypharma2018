function tspBruteForce(mode, currNode, currLen, currStep) {
// Set mode parameters:
var numSteps = numActive;
var lastNode = 0;
var numToVisit = numActive;
if (mode == 1) {
  numSteps = numActive - 1;
  lastNode = numActive - 1;
  numToVisit = numActive - 1;
}

// If this route is promising:
if (currLen + dur[currNode][lastNode] < bestTrip) {

// If this is the last node:
if (currStep == numSteps) {
  currLen += dur[currNode][lastNode];
  currPath[currStep] = lastNode;
  bestTrip = currLen;
  for (var i = 0; i <= numSteps; ++i) {
    bestPath[i] = currPath[i];
  }
} else {

// Try all possible routes:
for (var i = 1; i < numToVisit; ++i) {
  if (!visited[i]) {
    visited[i] = true;
    currPath[currStep] = i;
    tspBruteForce(mode, i, currLen+dur[currNode][i], currStep+1);
    visited[i] = false;
  }
}
}
}
}

/* Solves the TSP problem to optimality. Memory requirement is
* O(numActive * 2^numActive)
*/
function tspDynamic(mode) {
  var numCombos = 1<<numActive;
  var C = new Array();
  var parent = new Array();
  for (var i = 0; i < numCombos; ++i) {
    C[i] = new Array();
    parent[i] = new Array();
    for (var j = 0; j < numActive; ++j) {
      C[i][j] = 0.0;
      parent[i][j] = 0;
    }
  }
  for (var k = 1; k < numActive; ++k) {
    var index = 1 + (1<<k);
    C[index][k] = dur[0][k];
  }
  for (var s = 3; s <= numActive; ++s) {
    for (var i = 0; i < numActive; ++i) {
      nextSet[i] = 0;
    }
    var index = nextSetOf(s);
    while (index >= 0) {
      for (var k = 1; k < numActive; ++k) {
        if (nextSet[k]) {
          var prevIndex = index - (1<<k);
          C[index][k] = maxTripSentry;
          for (var m = 1; m < numActive; ++m) {
            if (nextSet[m] && m != k) {
              if (C[prevIndex][m] + dur[m][k] < C[index][k]) {
                C[index][k] = C[prevIndex][m] + dur[m][k];
                parent[index][k] = m;
              }
            }
          }
        }
      }
      index = nextSetOf(s);
    }
  }
  for (var i = 0; i < numActive; ++i) {
    bestPath[i] = 0;
  }
  var index = (1<<numActive)-1;
  if (mode == 0) {
    var currNode = -1;
    bestPath[numActive] = 0;
    for (var i = 1; i < numActive; ++i) {
      if (C[index][i] + dur[i][0] < bestTrip) {
        bestTrip = C[index][i] + dur[i][0];
        currNode = i;
      }
    }
    bestPath[numActive-1] = currNode;
  } else {
    var currNode = numActive - 1;
    bestPath[numActive-1] = numActive - 1;
    bestTrip = C[index][numActive-1];
  }
  for (var i = numActive - 1; i > 0; --i) {
    currNode = parent[index][currNode];
    index -= (1<<bestPath[i]);
    bestPath[i-1] = currNode;
  }
}