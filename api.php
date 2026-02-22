<?php
require_once 'config.php';

// Ensure the response is JSON
header('Content-Type: application/json');

// Receive raw POST data sent from JavaScript fetch
$input = json_decode(file_get_contents('php://input'), true);
$topic = $input['topic'] ?? '';

// Basic validation
if (empty($topic)) {
    echo json_encode(['error' => 'Please enter a research topic.']);
    exit;
}

// System Prompt Engineering for extracting MeSH Terms precisely
$systemPrompt = "You are a professional medical librarian and expert in biomedical informatics. Your task is to convert the user's natural language research topic into a highly accurate and standardized PubMed search query.
Rules:
1. Identify key concepts and map them to appropriate Medical Subject Headings (MeSH) terms using the `[Mesh]` tag.
2. Use appropriate Boolean operators (AND, OR) to combine terms logically.
3. Return ONLY the final query string. Do not provide explanations, introductions, or any other text.
Example Output: (\"Nitrates\"[Mesh] AND \"Drinking Water\"[Mesh]) AND \"Water Supply\"[Mesh]";

// Data payload for the Groq API request
$data = [
    'model' => GROQ_MODEL,
    'messages' => [
        ['role' => 'system', 'content' => $systemPrompt],
        ['role' => 'user', 'content' => "Convert this research topic to a standardized PubMed query: " . $topic]
    ],
    // Low temperature ensures deterministic and precise responses suited for scientific querying
    'temperature' => 0.1
];

// Initialize cURL session
$ch = curl_init(GROQ_API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . GROQ_API_KEY,
    'Content-Type: application/json'
]);

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);

curl_close($ch);

// Check for immediate cURL errors or non-200 HTTP status
if ($response === false || $httpCode !== 200) {
    // Log the actual error server-side if needed, send generic error to client
    echo json_encode(['error' => 'Error communicating with the AI server. ' . ($curlError ? "Details: $curlError" : "")]);
} else {
    // Output the raw response from Groq
    echo $response;
}