from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
import numpy as np
from PIL import Image
import base64
import io

app = Flask(__name__)
CORS(app)  # supaya aman dari masalah CORS

# Load model sekali saat server start
model = tf.keras.models.load_model("trash.h5")

classes = ['cardboard', 'glass', 'metal', 'paper', 'plastic', 'trash']

# Mapping kategori
category_map = {
    'cardboard': 'anorganik',
    'glass': 'anorganik',
    'metal': 'anorganik',
    'plastic': 'anorganik',
    'paper': 'organik',
    'trash': 'organik'
}

@app.route("/health", methods=["GET"])
def health():
    return jsonify({
        "status": "ok",
        "model_loaded": True
    })

@app.route("/predict", methods=["POST"])
def predict():
    data = request.get_json()

    if not data or 'image' not in data:
        return jsonify({
            "success": False,
            "message": "No image provided"
        }), 400

    try:
        # Ambil base64, buang prefix data:image/xxx;base64,
        image_base64 = data['image']
        image_base64 = image_base64.split(",")[1]

        # Decode base64 → image
        image_bytes = base64.b64decode(image_base64)
        img = Image.open(io.BytesIO(image_bytes)).convert("RGB")
        img = img.resize((180, 180))

        # Preprocess
        img = np.array(img) / 255.0
        img = np.expand_dims(img, axis=0)

        # Predict
        preds = model.predict(img)[0]

        class_index = int(np.argmax(preds))
        predicted_class = classes[class_index]
        confidence = float(preds[class_index])

        # Semua probabilitas
        all_predictions = {
            classes[i]: float(preds[i]) for i in range(len(classes))
        }

        category = category_map[predicted_class]

        return jsonify({
            "class": predicted_class,
            "category": category,
            "confidence": confidence,
            "all_predictions": all_predictions
        }), 200

    except Exception as e:
        return jsonify({
            "success": False,
            "message": "Prediction error",
            "error": str(e)
        }), 500


if __name__ == "__main__":
    app.run(host="127.0.0.1", port=5001, debug=True)
