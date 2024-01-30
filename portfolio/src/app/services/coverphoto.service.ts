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


  constructor(private http:HttpClient) { }

  getCoverPhoto():Observable<Response<CoverPhoto[]>>{
    const url:string = `${environment.urlApi}/api/coverphoto/${environment.userEmail}`
    return this.http.get<Response<CoverPhoto[]>>(url)
  }

}
