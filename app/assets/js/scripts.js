/**
 * Created by oshry on 5/17/15.
 */
var Search = Search || {};
Search.Contacts = function(){
    function search($this){
        var query = $this;
        var data = {query: query};
        $.ajax({
            url:"../src/http/Users/Search",
            data: data,
            type: "GET",
            dataType: "json",
            success: function(res){
                var tmpl = $("#name_matches_tmpl").html();
                var html = Mustache.to_html(tmpl, res);
                $("#search_results").html(html);
            }
        });
    }
    return{
        Search: search
    }
}(jQuery);
