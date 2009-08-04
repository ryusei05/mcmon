/**
 * Memcache monitor client
 * 
 * (Depends on prototype.js)
 * 
 * @author: Jason Hinkle http://www.verysimple.com
 * @version 1.0
 */

var numServers = 0;
var frequency = 2000;
var halt = false;

/**
 * how many servers to monitor
 */
function setNumServers(num)
{
	numServers = num;
}

/**
 * frequency in miliseconds to post to service.php
 */
function setFrequency(val)
{
	frequency = val;
}

/**
 * start monitoring
 */
function startMonitor()
{
	halt = false;
	updateNext(-1);
	$('status').update('Running');
	$('status').removeClassName('stopped')
	$('status').addClassName('running')
	$('start').setStyle({display: 'none'});
	$('stop').setStyle({display: ''});
}

/**
 * halt monitoring
 */
function stopMonitor()
{
	halt = true;
	$('status').update('Stopped');
	$('status').removeClassName('running')
	$('status').addClassName('stopped')
	$('start').setStyle({display: ''});
	$('stop').setStyle({display: 'none'});
}

/**
 * makes the ajax post to service.php
 */
function updateStatus(id)
{
	$('result_'+id).removeClassName('error')
	$('result_'+id).removeClassName('ok')
	// $('result_'+id).update('OK');

	new Ajax.Request('service.php?id='+id, {
		method:'get',
		onSuccess: function(transport) { onUpdateStatus(id,transport.responseJSON); },
		onFailure: function() { onUpdateFail(id,'Conn Error'); }
		}
	);
}

/**
 * on success from ajax, update the UI
 */
function onUpdateStatus(id, r)
{
	if (r == null) return onUpdateFail(id,'Resp Error');
	if (r == false) return onUpdateFail(id,'No Response');

	var utilization = (r.bytes / r.limit_maxbytes) * 100;
	$('utilization_'+id).update(utilization.toFixed(2) + '%');
	
	var w = Math.round( utilization * ($('utilization_bar_'+id).getWidth()/100) );
	$('utilization_bar_b_'+id).setStyle({width: w+'px'});
	
	$('pid_'+id).update(r.pid);
	$('uptime_'+id).update(r.uptime);
	$('time_'+id).update(r.pidtime);
	$('version_'+id).update(r.version);
	$('pointer_size_'+id).update(r.pointer_size);
	$('curr_items_'+id).update(r.curr_items);
	$('total_items_'+id).update(r.total_items);
	$('bytes_'+id).update(r.bytes);
	$('curr_connections_'+id).update(r.curr_connections);
	$('total_connections_'+id).update(r.total_connections);
	$('connection_structures_'+id).update(r.connection_structures);
	$('cmd_get_'+id).update(r.cmd_get);
	$('cmd_set_'+id).update(r.cmd_set);
	$('get_hits_'+id).update(r.get_hits);
	$('get_misses_'+id).update(r.get_misses);
	$('bytes_read_'+id).update(r.bytes_read);
	$('bytes_written_'+id).update(r.bytes_written);
	$('limit_maxbytes_'+id).update(r.limit_maxbytes);

	$('result_'+id).update('OK');
	$('result_'+id).addClassName('ok')

	updateNext(id);
}

/**
 * on success from ajax, update the UI
 */
function onUpdateFail(id,msg)
{
	$('result_'+id).update(msg);
	$('result_'+id).addClassName('error')
	
	updateNext(id);
}

/**
 * proceed with the next server unless the user halted
 */
function updateNext(id)
{
	if (!halt)
	{
		var nextId = (id >= (numServers-1)) ? 0 : (id + 1);
		setTimeout('updateStatus('+nextId+')', frequency);
	}

}