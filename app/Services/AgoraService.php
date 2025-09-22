<?php

namespace App\Services;

class AgoraService
{
    private string $appId;
    private string $appCertificate;

    public function __construct()
    {
        $this->appId = config('agora.app_id');
        $this->appCertificate = config('agora.app_certificate');
    }

    /**
     * Generate Agora RTC token for video calling
     */
    public function generateRtcToken(string $channelName, int $userId, int $expireTimeInSeconds = 3600): string
    {
        if (empty($this->appCertificate)) {
            return '';
        }

        $currentTimestamp = time();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        return $this->buildTokenWithUserAccount($channelName, $userId, $privilegeExpiredTs);
    }

    /**
     * Generate temporary token for testing (without certificate)
     */
    public function generateTempToken(string $channelName): string
    {
        return ''; // For testing without certificate
    }

    /**
     * Build token with user account
     */
    private function buildTokenWithUserAccount(string $channelName, int $userId, int $privilegeExpiredTs): string
    {
        $token = $this->generateAccessToken2(
            $this->appId,
            $this->appCertificate,
            $channelName,
            $userId,
            1, // Host role
            $privilegeExpiredTs,
            $privilegeExpiredTs
        );

        return $token;
    }

    /**
     * Generate AccessToken2 for Agora
     * Simplified version - for production use the official Agora token server
     */
    private function generateAccessToken2(
        string $appId,
        string $appCertificate,
        string $channelName,
        int $uid,
        int $role,
        int $tokenExpire,
        int $privilegeExpire
    ): string {
        // This is a simplified implementation
        // For production, use the official Agora token generation library
        // or implement the complete token algorithm

        $version = '007';
        $randomInt = mt_rand(1, 0xFFFFFFFF);
        $timestamp = time();

        $signature = $this->generateSignature(
            $appId,
            $appCertificate,
            $channelName,
            $uid,
            $timestamp,
            $randomInt,
            $tokenExpire,
            $privilegeExpire
        );

        $content = base64_encode(json_encode([
            'salt' => $randomInt,
            'ts' => $timestamp,
            'privileges' => [
                1 => $privilegeExpire, // JOIN_CHANNEL
                2 => $privilegeExpire, // PUBLISH_AUDIO_STREAM
                3 => $privilegeExpire, // PUBLISH_VIDEO_STREAM
                4 => $privilegeExpire, // PUBLISH_DATA_STREAM
            ]
        ]));

        return $version . $appId . base64_encode($signature) . $content;
    }

    /**
     * Generate signature (simplified)
     */
    private function generateSignature(
        string $appId,
        string $appCertificate,
        string $channelName,
        int $uid,
        int $timestamp,
        int $salt,
        int $tokenExpire,
        int $privilegeExpire
    ): string {
        $message = $appId . $channelName . $uid . $timestamp . $salt . $tokenExpire . $privilegeExpire;
        return hash_hmac('sha256', $message, $appCertificate, true);
    }

    /**
     * Validate if Agora is properly configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->appId);
    }

    /**
     * Get app ID for frontend
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * Create channel name for consultation
     */
    public function createChannelName(int $consultationId): string
    {
        return 'consultation_' . $consultationId . '_' . time();
    }
}