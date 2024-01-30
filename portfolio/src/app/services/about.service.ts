import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import About from '../models/About';
import Response from '../models/Response';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AboutService {

  constructor(private http:HttpClient) { }

  getAbout():Observable<Response<About>>{
    const url:string = `${environment.urlApi}/api/about/${environment.userEmail}`
    return this.http.get<Response<About>>(url)
  }

}
