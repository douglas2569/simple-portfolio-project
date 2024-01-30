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
  private userEmail:string = 'root@gmail.com'
  private URL:string = `${environment.urlApi}/${this.userEmail}/about`

  constructor(private http:HttpClient) { }

  getAbout():Observable<Response<About>>{
    return this.http.get<Response<About>>(this.URL)
  }

}
