import cv2
import mediapipe as mp
import numpy as np

# Initialize Mediapipe Hand Tracking
mp_hands = mp.solutions.hands
mp_draw = mp.solutions.drawing_utils
hands = mp_hands.Hands(min_detection_confidence=0.7, min_tracking_confidence=0.7)

# Load the image
image = cv2.imread("leaderXandrid1.png")  # Replace with your image
h, w, _ = image.shape
scale = 1.0  # Initial scale factor

def calculate_distance(p1, p2):
    return np.sqrt((p1[0] - p2[0]) ** 2 + (p1[1] - p2[1]) ** 2)

# Start webcam
cap = cv2.VideoCapture(0)
prev_distance = None

while cap.isOpened():
    ret, frame = cap.read()
    if not ret:
        break

    # Flip image for a mirror effect
    frame = cv2.flip(frame, 1)
    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    result = hands.process(rgb_frame)

    if result.multi_hand_landmarks:
        for hand_landmarks in result.multi_hand_landmarks:
            mp_draw.draw_landmarks(frame, hand_landmarks, mp_hands.HAND_CONNECTIONS)

            # Get thumb (4) and index finger tip (8) positions
            thumb_tip = hand_landmarks.landmark[4]
            index_tip = hand_landmarks.landmark[8]

            # Convert to pixel coordinates
            thumb_pos = (int(thumb_tip.x * w), int(thumb_tip.y * h))
            index_pos = (int(index_tip.x * w), int(index_tip.y * h))

            # Calculate distance
            curr_distance = calculate_distance(thumb_pos, index_pos)

            if prev_distance is not None:
                if curr_distance > prev_distance + 10:
                    scale = min(scale * 1.1, 3.0)  # Zoom In
                elif curr_distance < prev_distance - 10:
                    scale = max(scale * 0.9, 0.5)  # Zoom Out

            prev_distance = curr_distance

    # Resize image based on scale
    new_size = (int(w * scale), int(h * scale))
    resized_image = cv2.resize(image, new_size)

    # Show images
    cv2.imshow("Zoom Image", resized_image)
    cv2.imshow("Hand Detection", frame)

    if cv2.waitKey(1) & 0xFF == 27:  # Press 'ESC' to exit
        break

cap.release()
cv2.waitKey(1)
cv2.destroyAllWindows()


