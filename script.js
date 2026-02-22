document.addEventListener('DOMContentLoaded', () => {
    const generateBtn = document.getElementById('generateBtn');
    const topicInput = document.getElementById('topicInput');
    const resultArea = document.getElementById('resultArea');
    const queryText = document.getElementById('queryText');
    const pubmedLink = document.getElementById('pubmedLink');
    const originalBtnText = generateBtn.innerHTML;

    generateBtn.addEventListener('click', async () => {
        const topic = topicInput.value.trim();

        if (!topic) {
            alert('Please enter a research topic first.');
            topicInput.focus();
            return;
        }

        // Set loading state
        generateBtn.disabled = true;
        generateBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing with Llama 3 AI...';
        resultArea.style.display = 'none';

        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ topic: topic })
            });

            // Try to parse JSON, handle non-JSON responses gracefully
            let data;
            try {
                data = await response.json();
            } catch (e) {
                throw new Error("Invalid JSON response from server.");
            }

            if (!response.ok) {
                 throw new Error(data.error || `Server error: ${response.status}`);
            }

            if (data.choices && data.choices[0] && data.choices[0].message) {
                // Success: Extract the generated query
                const finalQuery = data.choices[0].message.content.trim();
                
                // Remove any surrounding quotes if the AI added them accidentally
                const cleanedQuery = finalQuery.replace(/^"|"$/g, '');

                // Update UI
                queryText.textContent = cleanedQuery;
                // Create the direct PubMed link with appropriate encoding
                pubmedLink.href = `https://pubmed.ncbi.nlm.nih.gov/?term=${encodeURIComponent(cleanedQuery)}`;
                resultArea.style.display = 'block';
                
                // Scroll to results
                resultArea.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

            } else if (data.error) {
                throw new Error(data.error);
            } else {
                throw new Error('Unexpected response structure from AI API.');
            }

        } catch (error) {
            console.error('Error:', error);
            alert(`An error occurred:\n${error.message}\n\nPlease check your connection or try again later.`);
        } finally {
            // Reset button state
            generateBtn.disabled = false;
            generateBtn.innerHTML = originalBtnText;
        }
    });
});