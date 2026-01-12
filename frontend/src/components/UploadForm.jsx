import { imageToBase64 } from "../utils/imageToBase64";
import { createPrediction } from "../api/predictionApi";
import { useState } from "react";

export default function UploadForm({ onResult }) {
  const [loading, setLoading] = useState(false);

  const handleFile = async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    setLoading(true);

    try {
      const base64 = await imageToBase64(file);

      const res = await createPrediction(base64);

      // Debug: lihat response asli dari backend
      console.log("FULL RESPONSE:", res.data);

      // Fleksibel: dukung backend pakai data atau langsung object
      const predictionData = res.data.data ?? res.data;

      onResult(predictionData);

    } catch (err) {
      console.error("Prediction Error:", err.response?.data || err.message);
      alert("Prediction failed. Check console for details.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="card p-4 shadow-sm">
      <input
        type="file"
        className="form-control mb-3"
        accept="image/*"
        onChange={handleFile}
      />

      {loading && (
        <div className="text-center">
          <div className="spinner-border text-primary" />
          <p className="mt-2">Processing image...</p>
        </div>
      )}
    </div>
  );
}
