<?php

namespace Shop\Service;

use stdClass;
use Symfony\Component\HttpClient\HttpClient;

class TwitterService extends BaseService
{
    protected $baseUrl;
    protected $client_id;
    protected $client_secret;
    protected $scope;
    protected $redirect_url;
    protected $redirect_endpoint;
    protected $state;

    protected UserService $userService;

    function __construct()
    {
        $this->baseUrl = "https://twitter.com/i/oauth2/authorize?response_type=code";
        $this->client_id = "UkJZdkFHLU9ZNlBIWkw3SW9KbXQ6MTpjaQ";
        $this->client_secret = "Z3fkyPDiVklC3zIAnSdh7YZrNMGTZz_q3r6e1b34dqsc3shjPW";
        $this->scope = "tweet.read+users.read+offline.access";
        $this->redirect_url = "https://jeremiahcann.dev/"; // This needs to change for each Dev for Twitter oAuth to work (Make sure it sends with the forward slash)
        $this->redirect_endpoint = "twitter/callback";
        $this->state = "";

        $this->userService = new UserService();
    }

    public function returnAuthInformation()
    {
        $state = $this->generateRandomString(50);
        $challenge = $this->base64_urlencode($state);
        $basicAuth = base64_encode($this->client_id . ":" . $this->client_secret);
        $url = $this->baseUrl . 
               "&client_id=" . $this->client_id . 
               "&state=" . $state .
               "&scope=" . $this->scope . 
               "&redirect_uri=" . urlencode($this->redirect_url . $this->redirect_endpoint) . 
               "&code_challenge=" . $challenge . 
               "&code_challenge_method=plain";

        $response = new stdClass();
        $response->url = $url;
        $response->state = $state;
        $response->challenge = $challenge;
        $response->basicAuth = $basicAuth;

        return $response;
    }

    public function getAccessToken($code, $challenge, $basicAuth)
    {
        $client = HttpClient::create();
        $response = $client->request("POST", "https://api.twitter.com/2/oauth2/token", 
        [
            'query' => [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'redirect_uri' => $this->redirect_url . $this->redirect_endpoint,
                'code_verifier' => $challenge
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Authorization' => "Basic $basicAuth"
            ]
        ]);

        if ($response->getStatusCode() != 200)
        {
            return array(false, $response->getContent());
        }

        return array(true, json_decode($response->getContent())->access_token);
    }

    public function registerUser($code, $challenge, $basicAuth, $userLoggedIn)
    {
        if ($userLoggedIn == null)
        {
            return array(false, "You must login first");
        }
        
        $accessToken = $this->getAccessToken($code, $challenge, $basicAuth);

        if (!$accessToken[0])
        {
            return array(false, $accessToken[1]);
        }

        $userId = $userLoggedIn->getUserId();
        $data = $this->getTwitterUser($accessToken[1]);

        $this->userService->createTwitterUser($userId, $data);
        return array(true);
    }

    public function loginUser($code, $challenge, $basicAuth)
    {
        $accessToken = $this->getAccessToken($code, $challenge, $basicAuth);

        if (!$accessToken[0])
        {
            return array(false, $accessToken[1]);
        }

        $twitterUser = $this->getTwitterUser($accessToken[1]);
        $user = $this->userService->getUserByTwitterId($twitterUser->id);

        if ($user == null)
        {
            return array(false, "No user is associated with this Twitter account");
        }

        return array(true, $user);
    }

    public function getTwitterUser($accessToken)
    {
        $client = HttpClient::create();
        $response = $client->request("GET", "https://api.twitter.com/2/users/me",
        [
            'headers' => [
                'Authorization' => "Bearer $accessToken"
            ]
        ]);

        return json_decode($response->getContent())->data;
    }
}