<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Swoole\WebSocket\Server;

class WebSocketServer extends Command
{
    protected $signature = 'websocket:serve';
    protected $description = 'Run WebSocket server using Swoole';

    public function handle()
    {
        $server = new Server("127.0.0.1", 6001);

        $server->on("handshake", function (Request $request, Response $response) {
            $response->header('Access-Control-Allow-Origin', 'http://localhost:8000');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            $response->header('Access-Control-Allow-Headers', 'Content-Type');
            
            if (!isset($request->header['sec-websocket-key'])) {
                $response->end();
                return false;
            }

            $key = base64_encode(sha1(
                $request->header['sec-websocket-key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11',
                true
            ));

            $response->header('Upgrade', 'websocket');
            $response->header('Connection', 'Upgrade');
            $response->header('Sec-WebSocket-Accept', $key);
            $response->status(101);
            $response->end();
        });

        $server->on("start", function ($server) {
            $this->info("Swoole WebSocket server started on ws://127.0.0.1:6001");
        });

        $server->on("open", function ($server, $req) {
            $this->info("Connection opened: {$req->fd}");
        });

        $server->on("message", function ($server, $frame) {
            $server->push($frame->fd, $frame->data);
        });

        $server->on("close", function ($server, $fd) {
            $this->info("Connection closed: {$fd}");
        });

        $server->start();
    }
}

