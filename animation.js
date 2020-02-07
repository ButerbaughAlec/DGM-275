$(document).ready(function()
{
    var slider = $("#slides");
    var slot_number = 10;
    var count = 1;
    
    $("#right_button").click(function()
    {
        count += 1;
        if(count > slot_number)
        {
            count = 1;
            slider.animate(
            {
                left: '-=100%'
            })
            slider.animate(
            {
                left: "+=1000%"
            }, 0);
        }
        else
        {
            slider.animate(
            {
                left: '-=100%'
            });
        }
    });
    
    $("#left_button").click(function()
    {
        count -= 1;
        if(count < 1)
        {
            count = 10;
            slider.animate(
            {
                left: '+=100%'
            })
            slider.animate(
            {
                left: "-=1000%"
            }, 10);
        }
        else
        {
            slider.animate(
            {
                left: '+=100%'
            });
        }
    });
});