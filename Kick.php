<?php

/*
__PocketMine Plugin__
name=Kick
version=0.0.1
author=C0deH4cker
class=Kick
*/

class Kick implements Plugin{
  private $api;
	public function __construct(ServerAPI $api, $server = false){
		$this->api = $api;
	}
	
	public function init(){
		$this->api->console->register("kick", "Kick a player", array($this, "handleCommand"));
	}
	
	public function __destruct(){
	
	}
	
	public function handleCommand($cmd, $arg){
		switch($cmd){
			case "kick":
				if(count($arg) == 0) {
					console("[INFO] Usage: kick <playername> [reason]");
				}
				else {
					// Kick player with message
					$name = array_shift($arg);
					$player = $this->api->player->get($name);
					if($player === false) {
						console("[ERROR] No player named ".$name);
					}
					else {
						$reason = implode(" ", $arg);
						console("Reason: ".$reason);
						$reason = $reason == "" ? "kicked" : $reason;
						console("Reason: ".$reason);
						$player->close($reason);
						console("[INFO] Kicked ".$player->username);
					}
				}
				break;
		}
	}

}
