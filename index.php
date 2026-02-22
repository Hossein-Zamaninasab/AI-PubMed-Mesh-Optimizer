<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI-Powered PubMed Query Optimizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; }
        .main-card { border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); border: none; }
        .card-header-custom { background-color: transparent; border-bottom: none; padding-bottom: 0; }
        .btn-primary-custom { background-color: #0d6efd; border: none; padding: 12px; font-weight: 600; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: #0b5ed7; transform: translateY(-2px); }
        /* Result box styling with left accent border for LTR layout */
        .result-box { background-color: #ffffff; border-left: 5px solid #198754; padding: 20px; border-radius: 8px; display: none; /* Hidden by default */ margin-top: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .query-code-block { background-color: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #dee2e6; font-family: 'Courier New', Courier, monospace; color: #d63384; word-break: break-word; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card main-card p-4">
                    <div class="card-header card-header-custom text-center mb-4">
                        <h2 class="fw-bold text-primary">PubMed Query Optimizer (MeSH)</h2>
                        <p class="text-muted">Powered by Llama 3 AI. Convert natural language into standardized MeSH queries.</p>
                    </div>
                    
                    <div class="card-body pt-0">
                        <div class="mb-4">
                            <label for="topicInput" class="form-label fw-semibold">Research Topic:</label>
                            <textarea id="topicInput" class="form-control form-control-lg" rows="3" placeholder="e.g., Impact of nitrate pollution on human health and drinking water safety..."></textarea>
                        </div>
                        
                        <button id="generateBtn" class="btn btn-primary-custom w-100 mb-3">
                            Generate Smart Query
                        </button>

                        <div id="resultArea" class="result-box">
                            <h5 class="fw-bold text-success mb-3">Optimized Query:</h5>
                            <code id="queryText" class="d-block query-code-block mb-4"></code>
                            
                            <div class="d-grid gap-2">
                                <a id="pubmedLink" href="#" target="_blank" class="btn btn-outline-success fw-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right me-2" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                        <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                    </svg>
                                    View Results directly on PubMed.gov
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 text-muted small">
                    Developed for research automation. Not affiliated with NCBI/PubMed.
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>