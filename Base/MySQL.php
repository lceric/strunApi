<?php 
define('DB_HOST', 'qdm169152214.my3w.com:3306');  
define('DB_USER', 'qdm169152214');  
define('DB_PWD', 'loveqin277');  
define('DB_CHARSET', 'UTF8');  
define('DB_DBNAME', 'qdm169152214_db');
class MySQL{
  function connectSQL () {
    // 创建连接
    $conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_DBNAME);
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    // echo "连接成功";
    $conn -> set_charset('utf8');
    return $conn;
  }

  // 增加
  function insert ($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "增加成功";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }

  // 增加多条数据 $sql使用$sql .= "INSERT INTO ;"连续赋值以分号分隔
  function insertMulti ($conn, $sql) {
    if ($conn->multi_query($sql) === TRUE) {
        echo "增加成功";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }

  // 查询数据
  function getDatas ($conn, $sql) {
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // print_r($result);
        $res = $this -> dpDatas($result);
        // print_r($res);
        // 输出数据
        return $res;
    } else {
        echo "0 结果";
    }
    $conn->close();
  }
  // 更新
  function update ($conn, $sql) {
    $result = $conn->query($query);
    if ($result){
      echo "更新操作执行成功";
    }else {
      echo "更新操作执行失败";
    }
    $conn->close();
  }

  // 删除
  function delete ($conn, $sql) {
    $result = $conn->query($query);
    if ($result){
      echo "删除操作执行成功";
    }else {
      echo "删除操作执行失败";
    }
    $conn->close();
  }

  // 处理数据，返回json数组
  function dpDatas ($sql_res) {
    $field_count=mysqli_num_fields($sql_res);
    $restemp = mysqli_fetch_all($sql_res);
    $p_res = array();
    foreach($restemp as $key => $value) {
        // print_r($value);
        $temp = array();
        for ($i = 0;$i < $field_count; ++$i) {
            $field_info = mysqli_fetch_field_direct($sql_res, $i);
            // print_r($field_info -> name);
            $subkey = str_replace('_', '', strtolower($field_info->name));
            $subtemp = array(
                $subkey => $value[$i]
            );
            $temp = array_merge($temp, $subtemp);
        }
        array_push($p_res, $temp);
    }
    return $p_res;
  }
}
?>