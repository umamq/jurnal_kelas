<?php
// Unique error identifier
$error_id = uniqid('error'); ?>
<style type="text/css">/*! normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css */
   html{font-family:sans-serif;line-height:1.15;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}header,nav,section{display:block}h1{font-size:2em;margin:.67em 0}main{display:block}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent;-webkit-text-decoration-skip:objects}a:active,a:hover{outline-width:0}b,strong{font-weight:inherit}b,strong{font-weight:bolder}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}svg:not(:root){overflow:hidden}body,html{width:100%;height:100%;background-color:#21232a}body{text-align:center;text-shadow:0 2px 4px rgba(0,0,0,.5);padding:0;min-height:100%;-webkit-box-shadow:inset 0 0 75pt rgba(0,0,0,.8);box-shadow:inset 0 0 75pt rgba(0,0,0,.8);display:table;font-family:"Open Sans",Arial,sans-serif}h1{font-family:inherit;font-weight:500;line-height:1.1;color:inherit;font-size:36px}h1 small{font-size:68%;font-weight:400;line-height:1;color:#777}a{text-decoration:none;color:#fff;font-size:inherit;border-bottom:dotted 1px #707070}#exception_error{background:#ddd;font-size:1em;font-family:sans-serif;text-align:left;color:#333}#exception_error h1,#exception_error h2{margin:0;padding:1em;font-size:1em;font-weight:normal;background:#911911;color:#fff}#exception_error h1 a,#exception_error h2 a{color:#fff}#exception_error h2{background:#666}#exception_error h3{margin:0;padding:.4em 0 0;font-size:1em;font-weight:normal}#exception_error p{margin:0;padding:.2em 0}#exception_error a{color:#1b323b}#exception_error pre{overflow:auto;white-space:pre-wrap}#exception_error table{width:100%;display:block;margin:0 0 .4em;padding:0;border-collapse:collapse;background:#fff}#exception_error table td{border:solid 1px #ddd;text-align:left;vertical-align:top;padding:.4em}#exception_error div.content{padding:.4em 1em 1em;overflow:hidden}#exception_error pre.source{margin:0 0 1em;padding:.4em;background:#fff;border:dotted 1px #b7c680;line-height:1.2em}#exception_error pre.source span.line{display:block}#exception_error pre.source span.highlight{background:#f0eb96}#exception_error pre.source span.line span.number{color:#666}#exception_error ol.trace{display:block;margin:0 0 0 2em;padding:0;list-style:decimal}#exception_error ol.trace li{margin:0;padding:0}.js .collapsed{display:none}
</style>
<script type="text/javascript">
document.documentElement.className="js";function koggle(b){b=document.getElementById(b);if(b.style&&b.style.display){var a=b.style.display}else{if(b.currentStyle){var a=b.currentStyle.display}else{if(window.getComputedStyle){var a=document.defaultView.getComputedStyle(b,null).getPropertyValue("display")}}}b.style.display=a=="block"?"none":"block";return false};
</script>

<div id="exception_error">
	<h1><span class="type"><?php echo $type ?> [ <?php echo $code ?> ]:</span> <span class="message"><?php echo $message ?></span></h1>
	<div id="<?php echo $error_id ?>" class="content">
		<p><span class="file"><?php echo MY_Exceptions::debug_path($file) ?> [ <?php echo $line ?> ]</span></p>
		
		<?php echo MY_Exceptions::debug_source($file, $line) ?>
		
		<ol class="trace">
			<?php foreach (MY_Exceptions::trace($trace) as $i => $step): ?>
			<li>
				<p>
					<span class="file">
					<?php if ($step['file']): $source_id = $error_id.'source'.$i; ?>
						<a href="#<?php echo $source_id ?>" onclick="return koggle('<?php echo $source_id ?>')"><?php echo MY_Exceptions::debug_path($step['file']) ?> [ <?php echo $step['line'] ?> ]</a>
					<?php else: ?>
						{<?php echo 'PHP internal call'; ?>}
					<?php endif ?>
					</span>
					&raquo;
					<?php echo $step['function'] ?>(<?php if ($step['args']): $args_id = $error_id.'args'.$i; ?><a href="#<?php echo $args_id ?>" onclick="return koggle('<?php echo $args_id ?>')"><?php echo 'arguments' ?></a><?php endif ?>)
				</p>
			<?php if (isset($args_id)): ?>
				<div id="<?php echo $args_id ?>" class="collapsed">
					<table cellspacing="0">
					<?php foreach ($step['args'] as $name => $arg): ?>
						<tr>
							<td><code><?php echo $name ?></code></td>
							<td><pre><?php echo print_r($arg, TRUE) ?></pre></td>
						</tr>
					<?php endforeach ?>
					</table>
				</div>
			<?php endif ?>
			<?php if (isset($source_id)): ?>
				<pre id="<?php echo $source_id ?>" class="source collapsed"><code><?php echo $step['source'] ?></code></pre>
			<?php endif ?>
			</li>
			<?php unset($args_id, $source_id); ?>
			<?php endforeach ?>
		</ol>
	</div>

	<h2><a href="#<?php echo $env_id = $error_id.'environment' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Environment' ?></a></h2>
	<div id="<?php echo $env_id ?>" class="content collapsed">
	
	<?php $included = get_included_files() ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment_included' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Included files' ?></a> (<?php echo count($included) ?>)</h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($included as $file): ?>
				<tr>
					<td><code><?php echo MY_Exceptions::debug_path($file) ?></code></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>

	<?php $included = get_loaded_extensions() ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment_loaded' ?>" onclick="return koggle('<?php echo $env_id ?>')"><?php echo 'Loaded extensions' ?></a> (<?php echo count($included) ?>)</h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($included as $file): ?>
				<tr>
					<td><code><?php echo MY_Exceptions::debug_path($file) ?></code></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>
		
	<?php foreach (array('_SESSION', '_GET', '_POST', '_FILES', '_COOKIE', '_SERVER') as $var): ?>
		<?php if (empty($GLOBALS[$var]) OR ! is_array($GLOBALS[$var])) continue ?>
		<h3><a href="#<?php echo $env_id = $error_id.'environment'.strtolower($var) ?>" onclick="return koggle('<?php echo $env_id ?>')">$<?php echo $var ?></a></h3>
		<div id="<?php echo $env_id ?>" class="collapsed">
			<table cellspacing="0">
			<?php foreach ($GLOBALS[$var] as $key => $value): ?>
				<tr>
					<td><code><?php echo $key ?></code></td>
					<td><pre><?php echo print_r($value, TRUE) ?></pre></td>
				</tr>
			<?php endforeach ?>
			</table>
		</div>
	<?php endforeach ?>
	</div>
</div>
