export default function PredictionResult({ result }) {
  if (!result) return null;

  return (
    <div className="card mt-4 shadow-sm">
      <div className="card-body">
        <h5 className="card-title">Prediction Result</h5>
        <p><strong>Class:</strong> {result.predicted_class}</p>
        <p><strong>Category:</strong> {result.category}</p>
        <p><strong>Confidence:</strong> {result.confidence_percent}</p>
      </div>
    </div>
  );
}
