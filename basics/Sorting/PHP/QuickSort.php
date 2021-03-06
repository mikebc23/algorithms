<?php
/*
* Basic example of Quicksort
* Divide-and-conquer alrorithm, like the merge
* 
* Complexity: O (n log n) 
*/

$numbers = [20, 6, 8, 53, 56, 23, 87, 41, 49, 19];

function quickSort($dataset, $first, $last) {
    
    if($first < $last) {
        # calculate the split point
        $pivotIdx = partition($dataset, $first, $last);

        # now sort the two partitions
        $dataset = quickSort($dataset, $first, $pivotIdx-1);
        $dataset = quickSort($dataset, $pivotIdx+1, $last);
    
        return $dataset;

    }
}

function partition($datavalues, $first, $last) {
    # choose the first item as the pivot value
    $pivotvalue = $datavalues[$first];
    # establish the upper and lower indexes
    $lower = $first++;
    $upper = $last;

    # start searching for the crossing point
    $done = false;
    while($done === false) {
        # advance the lower index
        while (($lower <= $upper) && ($datavalues[$lower] <= $pivotvalue)){
            $lower += 1;
        }

        # advance the upper index
        while (($datavalues[$upper] >= $pivotvalue) && ($upper >= $lower)) {
            $upper -= 1;
        }

        # if the two indexes cross, we have found the split point
        if ($upper < $lower){
            $done = true;
        }else{
            # exchange the two values
            $temp = $datavalues[$lower];
            $datavalues[$lower] = $datavalues[$upper];
            $datavalues[$upper] = $temp;
        }
    }

    # when the split point is found, exchange the pivot value
    $temp = $datavalues[$first];
    $datavalues[$first] = $datavalues[$upper];
    $datavalues[$upper] = $temp;

    # return the split point index
    return $upper;
}


echo "Original: " . json_encode($numbers) . "\n";

$result = quickSort($numbers, 0, count($numbers)-1);
echo "Result:   " . json_encode($result) . "\n";
