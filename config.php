<?php
// Groq API Configurations
// Replace 'YOUR_GROQ_API_KEY_HERE' with your actual API key from Groq Cloud console.
define('GROQ_API_KEY', 'YOUR_GROQ_API_KEY_HERE');

// Using Llama 3 70B for high accuracy in understanding scientific terms
define('GROQ_MODEL', 'llama-3.3-70b-versatile');

// Groq OpenAI-compatible endpoint URL
define('GROQ_API_URL', 'https://api.groq.com/openai/v1/chat/completions');
?>