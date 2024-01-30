import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import CoverPhoto from '../models/CoverPhoto';
import Response from '../models/Response';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CoverPhotoService {
  private userEmail:string = 'root@gmail.com'
  private URL:string = `${environment.urlApi}/coverphoto/${this.userEmail}`

  constructor(private http:HttpClient) { }

  getCoverPhoto():Observable<Response<CoverPhoto[]>>{
    return this.http.get<Response<CoverPhoto[]>>(this.URL)
  }

}
