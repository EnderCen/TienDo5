<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class AIController extends Controller
{
    private $uploadDir = 'uploads';
    private $staticDir = 'static';

    public function faceSwap(Request $request)
    {
        // Validate file upload
        $request->validate([
            'source' => 'required|file|mimes:jpg,jpeg,png',
            'target' => 'required|file|mimes:jpg,jpeg,png',
        ]);

        // Lưu file upload
        $sourceFile = $request->file('source');
        $targetFile = $request->file('target');
        $sourcePath = $sourceFile->storeAs($this->uploadDir, $sourceFile->getClientOriginalName(), 'local');
        $targetPath = $targetFile->storeAs($this->uploadDir, $targetFile->getClientOriginalName(), 'local');
        $outputPath = public_path("{$this->staticDir}/output.jpg");

        // Chạy script Python để Face Swap
        $command = [
            'python3',
            base_path('scripts/run.py'), // Đường dẫn tới script run.py
            '-s', storage_path("app/{$sourcePath}"),
            '-t', storage_path("app/{$targetPath}"),
            '-o', $outputPath,
            '--frame-processor', 'face_swapper'
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json(['message' => 'Face swap completed!']);
    }

    public function textToSpeech(Request $request)
    {
        // Validate input
        $request->validate([
            'text' => 'required|string',
            'voice' => 'required|string',
        ]);

        $text = $request->input('text');
        $voice = $request->input('voice');
        $outputAudio = public_path("{$this->staticDir}/output.wav");

        // Chạy lệnh viettts
        $command = [
            'viettts',
            'synthesis',
            '--text', $text,
            '--voice', $voice,
            '--output', $outputAudio
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json(['output_audio' => "/{$this->staticDir}/output.wav"]);
    }

    public function animateImage(Request $request)
    {
        $imagePath = public_path("{$this->staticDir}/output.jpg");
        $audioPath = public_path("{$this->staticDir}/output.wav");
        $resultDir = public_path($this->staticDir);

        // Chạy script inference.py
        $command = [
            'python3',
            base_path('scripts/inference.py'), // Đường dẫn tới script inference.py
            '--driven_audio', $audioPath,
            '--source_image', $imagePath,
            '--still',
            '--preprocess', 'full',
            '--cpu',
            '--result_dir', $resultDir
        ];

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Tìm file video đầu ra
        $outputVideo = null;
        foreach (glob("{$resultDir}/*.mp4") as $file) {
            $outputVideo = basename($file);
            break;
        }

        if (!$outputVideo) {
            return response()->json(['error' => 'No output video found'], 500);
        }

        // Chuyển đổi video bằng FFmpeg
        $outputVideoPath = "{$resultDir}/{$outputVideo}";
        $outputVideoWeb = "{$resultDir}/output_web.mp4";
        $ffmpegCommand = [
            'ffmpeg',
            '-i', $outputVideoPath,
            '-y', '-vcodec', 'libx264', '-acodec', 'aac',
            $outputVideoWeb
        ];

        $ffmpegProcess = new Process($ffmpegCommand);
        $ffmpegProcess->run();

        if (!$ffmpegProcess->isSuccessful()) {
            throw new ProcessFailedException($ffmpegProcess);
        }

        return response()->json(['output_video' => "/{$this->staticDir}/output_web.mp4"]);
    }
}