<?php

if(!defined('ABSPATH')) exit;

class EdgefTwitterHelper {

	public function getTweetCleanText($tweet) {
		if(!empty($tweet['text'])) {

			return $tweet['text'];
		}

		return '';
	}

	public function getTweetText($tweet) {
        $protocol = is_ssl() ? 'https' : 'http';
        if(!empty($tweet['text'])) {
            //add links around https or http parts of text
            $tweet['text'] = preg_replace('/(https?)\:\/\/([a-z0-9\/\.\&\#\?\-\+\~\_\,]+)/i', '<a target="_blank" href="'.('$1://$2').'">$1://$2</a>', $tweet['text']);

            //add links around @mentions
            $tweet['text'] = preg_replace('/\@([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="'.esc_url($protocol.'://twitter.com/$1').'">@$1</a>', $tweet['text']);

            return $tweet['text'];
        }

        return '';
    }

    public function getTweetTime($tweet) {
        if(!empty($tweet['created_at'])) {
            return human_time_diff(strtotime($tweet['created_at']), current_time('timestamp') ).' '.__('ago', 'edgt');
        }

        return '';
    }

	public function getTweetCreatedTime($tweet) {
		if(!empty($tweet['created_at'])) {
			return date("F d, Y", strtotime($tweet['created_at']));
		}

		return '';
	}

    public function getTweetURL($tweet) {
        if(!empty($tweet['id_str']) && $tweet['user']['screen_name']) {
            return 'https://twitter.com/'.$tweet['user']['screen_name'].'/statuses/'.$tweet['id_str'];
        }

        return '#';
    }

	public function getTweetAuthor($tweet) {
		if(!empty($tweet['user'])) {
			return $tweet['user']['screen_name'];
		}

		return '';
	}
}