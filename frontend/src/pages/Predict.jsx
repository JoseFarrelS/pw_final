import { useState } from "react";
import UploadForm from "../components/UploadForm";
import PredictionResult from "../components/PredictionResult";

export default function Predict() {
  const [result, setResult] = useState(null);

  return (
    <div>
      <h2>Waste Classification</h2>
      <UploadForm onResult={setResult} />
      <PredictionResult result={result} />
    </div>
  );
}
