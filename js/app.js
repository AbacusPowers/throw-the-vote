/**
 * Created by justin on 8/21/16.
 */
$('form').on('submit',function(e){
    e.preventDefault();
    console.log('Sending request to '+$(this).attr('action')+' with data: '+$(this).serialize());
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : $(this).attr('action'),
        data     : $(this).serialize(),
        success  : function(data) {
            $(".form-main").empty().append(data).css('visibility','visible').removeClass("col-md-8").addClass("col-md-12");
            $(".page-head").removeClass("col-md-8").addClass("col-md-12");
            $(".form-info").empty();
        }
    });

});
//# sourceMappingURL=app.js.map
