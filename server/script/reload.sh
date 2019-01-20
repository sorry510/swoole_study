echo "reloading..."
pid=`pidof xxx`
# echo $pid
# 重启所有worker进程
kill -USER1 $pid
# 重启所有task进程
kill -USER2 $pid
echo "reloading success"