<?php
/**
 * 多次元配列の並び替え
 * https://qiita.com/yukibe/items/d98f8c7250b5f3987947
 *
 * @param (string) $key*: 並び替えたいキー
 * @param (array) $array: 並び替えたい配列
 * @param (SORT_DESC|SORT_ASC) 降順、昇順
 * @return (array)
 */
function sort_by_key($key_name, $array, $sort = SORT_DESC) {
  $temp_array = [];
  
  foreach ($array as $key => $value) {
    $temp_array[$key] = $value[$key_name];
  }
  
  array_multisort($temp_array, $sort, $array);
  return $array;  
}

/*
$clothes = array(
    array(
        'type' => 'male',
        'size' => 'S',
        'release_date' => '2019-04-10'
    ),
    array(
        'type' => 'female',
        'size' => 'M',
        'release_date' => '2019-02-15'
    ),
    array(
        'type' => 'child',
        'size' => 'S',
        'release_date' => '2019-01-05'
    ),
    array(
        'type' => 'female',
        'size' => 'M',
        'release_date' => '2019-05-20'
    ),
    array(
        'type' => 'male',
        'size' => 'L',
        'release_date' => '2019-03-30'
    )
);

// A. 1つのキー（カラム）を基準にソートする
// 指定したキーに対応する値を基準に、配列をソートする
function sortByKey($key_name, $sort_order, $array) {
    foreach ($array as $key => $value) {
        $standard_key_array[$key] = $value[$key_name];
    }

    array_multisort($standard_key_array, $sort_order, $array);

    return $array;
}

// release_dateを昇順ソートする
$sorted_array = sortByKey('release_date', SORT_ASC, $clothes);


// B. 複数のキー（カラム）を基準にソートする
// ソートの基準となるキーに対応する値の配列を作成
function createArrayForSort($key_name, $array) {
    foreach ($array as $key => $value) {
            $standard_key_array[$key] = $value[$key_name];
    }

    return $standard_key_array;
}

// 各キーを基準にソートできるように、対応する値の配列を作成
$type_array = createArrayForSort('type', $clothes);
$size_array = createArrayForSort('size', $clothes);
$release_date_array = createArrayForSort('release_date', $clothes);

// type, size, release_dateの優先順位で昇順ソートする
array_multisort($type_array, SORT_ASC, $size_array, SORT_ASC, $release_date_array, SORT_ASC, $clothes);


// C. ユーザー基準でソートする
// あらかじめ表示順の基準とするキーに対応する値をキーとした配列を作成する
$array_by_size = array(
    'S' => array(),
    'M' => array(),
    'L' => array()
    );

// 値に応じて各要素を振り分ける
foreach($clothes as $key => $value) {
    $array_by_size[$value['size']][] = $value;
}

// 多次元配列で扱いづらいため、次元を１つ減らす
$sorted_array = call_user_func_array('array_merge', $array_by_size);

// array_mergeも使用できる
// $merge_array = array();
// foreach($array_by_size as $key => $value) {
//     foreach ($value as $data) {
//         $sorted_array[] = array_merge($merge_array, $data);
//     }
// }


*/