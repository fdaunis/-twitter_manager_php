
var g_strid_last_tweet = "";

$(document).ready(function()
{
	$('#id_bt_show_more_tweets').hide();
	
	_show_configuration();
});


function _show_configuration()
{
	$('#id_span_username').text("loading...");
	
	_ajax_get_config();
}

function _ajax_get_config()
{
	var l_obj_span_username = $('#id_span_username');
	
	l_obj_span_username.text("loading...");
	
	$.post("./ajax/ajax.php","p_mode=GET-CONFIG", function (p_xml) 
	{
		var l_llista = p_xml.getElementsByTagName("response");
		if (l_llista.length == 1)
		{
			if (l_llista[0].getAttribute('resultat') == "OK")
			{
				l_obj_span_username.text(l_llista[0].getAttribute('username'));
			}
		}
		else alert('Ajax Error!');
	});
}

function Event_Click_Button_Show_Tweets()
{
	g_strid_last_tweet = "";
	$('#id_bt_show_tweets').hide();
	$('#id_bt_show_more_tweets').hide();
	
	
	_ajax_get_html_tweets();
}

function Event_Click_Button_More_Tweets()
{
	$('#id_bt_show_tweets').hide();
	$('#id_bt_show_more_tweets').hide();
	
	_ajax_get_html_tweets();
}



function _ajax_get_html_tweets()
{
	$('#id_div_loading').html('<img src="assets/img/loading.gif" style="width:32px" >');
	
	
	$.post("./ajax/ajax.php","p_mode=GET-HTML-TWEETS&p_strid_last_tweet="+g_strid_last_tweet, function (p_html) 
	{
		$('#id_div_loading').html('');
		$('#id_div_resultat').prepend(p_html);
		$('#id_bt_show_tweets').show();
		$('#id_bt_show_more_tweets').show();
	});
}


function _set_last_strid(p_str_id_last_tweet)
{
	g_strid_last_tweet = p_str_id_last_tweet;
	
}