import cv2
from simple_facerec import SimpleFacerec
import numpy as np
import time
import getpass
from datetime import datetime

# Encode faces from a folder
sfr = SimpleFacerec()
sfr.load_encoding_images("upload/img_student/")

# Load Camera
cap = cv2.VideoCapture(0)
frameRate = cap.get(5) #frame rate
eye_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_eye.xml')

cur_time = time.time() # Get current time

# start_time_24h measures 24 hours
start_time_24h = cur_time

# start_time_1min measures 1 minute
start_time_1min = cur_time -55 # Subtract 5 seconds for start grabbing first frame after one second (instead of waiting a minute for the first frame).

while True:
    ret, frame = cap.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    cur_time = time.time() # Get current time
    elapsed_time_1min = cur_time - start_time_1min # Time elapsed from previous image saving.

    # Detect Faces
    face_locations, face_names = sfr.detect_known_faces(frame)
    for face_loc, name in zip(face_locations, face_names):
        y1, x2, y2, x1 = face_loc[0], face_loc[1], face_loc[2], face_loc[3]
        #top, left, bottom, right = face_loc[0], face_loc[1],face_loc[2], face_loc[3]
        cv2.putText(frame, name,(x1, y1 - 10), cv2.FONT_HERSHEY_DUPLEX, 1, (0, 255, 0), 2)
        cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 4)
        roi_gray = gray[y1:y2, x1:x2]
        roi_color = frame[y1:y2, x1:x2]
        eyes = eye_cascade.detectMultiScale(roi_gray, 1.3, 5)
        for (ex, ey, ew, eh) in eyes:
            cv2.rectangle(roi_color, (ex, ey), (ex + ew, ey + eh), (0, 255, 0), 5)

    cur_time = time.time() # Get current time
    elapsed_time_1min = cur_time - start_time_1min # Time elapsed from previous image saving.

    if elapsed_time_1min >= 5:
        start_time_1min = cur_time
        filename = str(datetime.now().strftime("%d-%m-%Y_%I-%M-%S_%p")) + ".jpg"
        #filename = “image_” + str(datetime.now().strftime(“%d-%m-%Y_%I-%M-%S_%p”)) + “.jpg”
        cv2.imwrite(filename, frame)


    cv2.imshow("Frame", frame)
    elapsed_time_24h = time.time() - start_time_24h

    # กด esc เพื่อออก
    key = cv2.waitKey(1)
    if key == 27:
        break

cap.release()
cv2.destroyAllWindows()
