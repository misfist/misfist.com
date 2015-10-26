<?php
$q = $_GET;

if (isset($q['to'])) {
	$r = $q['to'];
	unset($q['to']);

	$parts = parse_url($r);
	if (empty($parts['query'])) {
		$parts['query'] = http_build_query($q);
	} else {
		$parts['query'] = $parts['query'] . '&' . http_build_query($q);
	}

	$redirect_url = '';

	if (isset($parts['scheme'])) {
		$redirect_url .= $parts['scheme'] . '://';
	}

	if (isset($parts['user'])) {
		$redirect_url .= $parts['user'];

		if (isset($parts['pass'])) {
			$redirect_url .= ':' . $parts['pass'];
		}

		$redirect_url .= '@';
	}

	if (isset($parts['host'])) {
		$redirect_url .= $parts['host'];
	}

	if (isset($parts['port'])) {
		$redirect_url .= ':' . $parts['port'];
	}

	if (isset($parts['path'])) {
		$redirect_url .= $parts['path'];
	} else {
		$redirect_url .= '/';
	}

	if (isset($parts['query'])) {
		$redirect_url .= '?' . $parts['query'];
	}

	if (isset($parts['fragment'])) {
		$redirect_url .= '#' . $parts['fragment'];
	}

	header('Location: ' . $redirect_url);
}