
let topicsArray = [
    "課程介紹",
    "隨機性",
    "不上課",
    "日期時間",
    "不上課",
    "條件判斷",
    ];

    let startDate = new Date();

    function setMonthAndDay(starMonth, startDay){
        //一次設定好月份與日期
        startDate.setMonth(starMonth-1 , startDay );
        //時分秒這個例子不會用到.歸0
        startDate.setHours(0);
        startDate.setMinutes(0);
        startDate.setSeconds(0);
    }

    //給社長用的
    setMonthAndDay(2,21);